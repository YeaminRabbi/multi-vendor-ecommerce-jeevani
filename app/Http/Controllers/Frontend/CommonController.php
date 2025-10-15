<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\Order;
use App\Models\Review;
use App\Models\Post;
use App\Models\Product;

class CommonController extends Controller
{
    public function about()
    {
        return view('frontend.pages.about');
    }

    public function signIn()
    {
        return view('frontend.pages.account.signin');
    }

    public function signUp()
    {
        return view('frontend.pages.account.signup');
    }

    public function forgotPassword()
    {
        return view('frontend.pages.account.forgot-password');
    }

    public function order()
    {

        $orders = Order::where('user_id', Auth::id())->latest()->get(['id', 'status', 'created_at', 'total']);
        return view('frontend.pages.account.order', compact('orders'));
    }

    public function orderItems(Order $order, $notificationId = null)
    {

        // Check if the authenticated user owns the order
        if ((int)$order->user_id !== Auth::id()) {
            abort(403, 'You do not have permission to access this order.');
        }

        if ($notificationId) {
            $notification = Auth::user()->notifications()->find($notificationId);
            $notification->markAsRead();
        }

        $orderItems = $order->items;
        $orderId = $order->id;

        return view('frontend.pages.account.order-items', compact('orderItems', 'orderId'));
    }

    public function settings()
    {
        $user = Auth::user();
        return view('frontend.pages.account.settings', compact('user'));
    }

    public function notification()
    {
        $notifications =  Auth::user()->notifications;
        return view('frontend.pages.account.notification', compact('notifications'));
    }

    public function paymentMethod()
    {
        return view('frontend.pages.account.payment-method');
    }

    public function contact()
    {
        return view('frontend.pages.contact');
    }

    public function blog()
    {
        return view('frontend.pages.blog.list');
    }

    public function blogSingle()
    {
        return view('frontend.pages.blog.single');
    }

    public function blogCategory()
    {
        return view('frontend.pages.blog.category');
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

        return back()->with(['status' => 'Account info updated']);
    }

    public function updateUserPassword(Request $request)
    {
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string',
        ]);

        // Get the authenticated user
        $user = auth()->user();

        // Check if the current password matches
        if (!Hash::check($request->current_password, $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        $user->update([
            'password' => Hash::make($request->new_password),
        ]);

        return back()->with('status', 'Password updated successfully.');
    }

    public function deleteAccount(Request $request)
    {
        $user = auth()->user();

        // Ensure the user is authenticated
        if (!$user) {
            return redirect()->route('login')->with('error', 'You need to be logged in to delete your account.');
        }

        // Remove all roles from the user (Spatie Permission)
        $user->roles()->detach();

        // Delete the user account
        $user->delete();

        // Log the user out after account deletion
        Auth::logout();

        // Redirect to a confirmation page or login page
        return redirect()->route('home');
    }

    public function productSearch(Request $request)
    {
        $query = $request->input('query');
        return view('frontend.pages.search', compact('query'));
    }

    public function getPage($slug = null)
    {

        $page = Post::with('featuredImage')->where('slug', $slug)->where('type', 'page')->where('is_published', 1)->first();

        if ($slug == null || !$page) {
            abort('404');
        }

        return view('frontend.pages.page', [
            'pageContent' => $page
        ]);
    }

    public function storeReview(Request $request, Product $product)
    {

        // Validate the incoming data
        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'review' => 'required|string|max:1000',
        ]);

        // Store the data in the database
        Review::create([
            'account_id' => Auth::id(), // Assuming the user is authenticated
            'product_id' => $product->id,
            'rate' => $request->input('rating'),
            'review' => $request->input('review'),
            'is_activated' => 0
        ]);

        // Redirect or return a response
        return redirect()->back()->with('review-success', 'Thank you for your review!');
    }
}
