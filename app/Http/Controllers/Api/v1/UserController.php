<?php

namespace App\Http\Controllers\Api\v1;

use App\Http\Controllers\Controller;
use App\Http\Resources\UserResource;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        return response()->json([
            'users' => User::role('admin')->latest()->get(),
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $role = Role::firstOrCreate(['name' => 'user']);

        $user->assignRole($role->name);

        return response()->json([
            'user' => $user,
        ]);
    }

    public function show($id)
    {
        $user = User::findOrFail($id);

        return response()->json([
            'user' => $user,
        ]);
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name' => 'required|string',
            'email' => 'required|string|email|unique:users,email,' . $user->id, // Ensure email is unique, excluding the current user's email
            'password' => 'nullable|string', // Password is optional during update
        ]);

        // Update user attributes
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password ? Hash::make($request->password) : $user->password, // Only hash the password if it is provided
        ]);

        return response()->json([
            'user' => $user,
        ]);
    }

    public function destroy(string $id)
    {
        $removed = $user = User::findOrFail($id);
        $user->delete();

        return response()->json([
            'message' => 'User deleted successfully!',
            'removed-user' => $removed,
        ]);
    }

    public function updateUserInfo(Request $request)
    {
        $user = auth()->user();

        // Define validation rules
        $rules = [
            'name' => 'required|string|max:255',
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                function ($attribute, $value, $fail) use ($user) {
                    // Check if the email is different from the current user's email
                    if ($value !== $user->email) {
                        // Check if the new email already exists
                        if (\App\Models\User::where('email', $value)->exists()) {
                            $fail('The email has already been taken.');
                        }
                    }
                },
            ],
            'phone' => [
                'nullable',
                'string',
                'regex:/^([+]{1}[8]{2}|0088)?(01){1}[3-9]{1}\d{8}$/', // BD format
            ],
        ];

        // Validate request
        $request->validate($rules);

        // Update user information
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone ?? null,
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'User information updated!',
            'data' => [
                'user' => new UserResource($user),
            ],
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return response()->json([
                'satus' => 403,
                'current_password' => 'The current password is incorrect.',
            ]);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return response()->json([
            'status' => 200,
            'message' => 'Password has been updated!',
            'data' => [
                'user' => new UserResource($user),
            ],
        ]);
    }


    public function accountDelete(Request $request){

        $user = auth()->user();

        // Remove all roles from the user (Spatie Permission)
        $user->roles()->detach();

        // Delete the user account
        $user->delete();

        // Log the user out after account deletion
        $user->tokens()->delete();
        session()->flush();

        return response()->json([
            'status' => 200,
            'message' => 'Account deleted successfully!',
        ]);
    }

    public function userInfo()
    {
        $user = auth()->user();

        return response()->json([
            'status' => 200,
            'data' => [
                'user' => new UserResource($user),
            ],
        ]);
        
    }
}
