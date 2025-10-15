<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{

    public function index()
    {
        $addresses = Address::where('user_id', Auth::id())->get();
        return view('frontend.pages.account.address.index', compact('addresses'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mark' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'business_name' => 'nullable|string|max:255',
        ]);

        Address::create([
            'user_id' => Auth::id(),
            'name' => $request->input('name'),
            'mark' => $request->input('mark'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'business_name' => $request->input('business_name'),
            'is_default' => $request->input('is_default', 0), // Default to 0 if not provided
        ]);

        return redirect()->back();
    }

    public function edit(Address $address)
    {
        // Check if the address belongs to the authenticated user
        if ($address->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        return view('frontend.pages.account.address.edit', compact('address'));

    }

    public function update(Request $request, Address $address)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'mark' => 'required|string|max:255',
            'address_line_1' => 'required|string|max:255',
            'address_line_2' => 'nullable|string|max:255',
            'city' => 'nullable|string|max:255',
            'country' => 'nullable|string|max:255',
            'state' => 'nullable|string|max:255',
            'zip_code' => 'nullable|string|max:20',
            'business_name' => 'nullable|string|max:255',
        ]);
        

        $address->update([
            'name' => $request->input('name'),
            'mark' => $request->input('mark'),
            'address_line_1' => $request->input('address_line_1'),
            'address_line_2' => $request->input('address_line_2'),
            'city' => $request->input('city'),
            'country' => $request->input('country'),
            'state' => $request->input('state'),
            'zip_code' => $request->input('zip_code'),
            'business_name' => $request->input('business_name'),
        ]);

        return redirect()->back();
        
    }

    public function destroy($id)
    {
        $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $address->delete();

        return redirect()->back();
    }

    public function setDefault($id)
    {
        Address::where('user_id', Auth::id())->update(['is_default' => 0]); // Reset all to non-default
        $address = Address::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $address->update(['is_default' => 1]);

        return redirect()->back();
    }
}
