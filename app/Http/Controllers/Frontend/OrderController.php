<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Company;
use App\Models\Order;
use App\Models\Cart;
use App\Models\OrderItem;
use App\Models\OrderLog;
use App\Models\Product;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Notifications\OrderPlacedNotification;

class OrderController extends Controller
{
    public static function placeOrder(Request $request , $apiResponse = false)
    {
        // Validate the incoming request
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required',
            'address' => 'required|string|max:1000',
            'notes' => 'nullable|string|max:1000',
            'payment_method' => 'required|in:cash,card',
        ]);

        // Handle session for guests or user_id for logged-in users
        $sessionId = $request->has('session_id') ? $request->session_id : session()->getId();
        $user = auth()->user();
        $userId = $user ? $user->id : null;
        
        // Begin a transaction to ensure all or nothing happens
        DB::beginTransaction();

        try {
            // Assume $cartItems is retrieved from session or wherever you're storing cart data
            $cartItems = Cart::where('session_id', $sessionId)->get();

            $account = Account::firstOrCreate(
                [
                    'id' => $userId,
                ],
                [
                    'username' => $user->email,
                    'type' => 'account',     // Attributes to set if creating a new record
                    'name' => $user->name,
                    'email' => $user->email,
                    'is_login' => 1,
                    'is_active' => 1,
                ]
            );

            $company = Company::firstOrCreate(
                [
                    'name' => 'Jeevani',
                    'country_id' => null,
                    'ceo' => null,
                    'address' => 'Mohammadpur, Dhaka',
                    'city' => 'Dhaka',
                    'zip' => '1207',
                    'registration_number' => null,
                    'tax_number' => null,
                    'email' => 'jeevani@gmail.com',
                    'phone' => '017',
                    'website' => null,
                    'notes' => null,
                ]
            );

            $order = Order::create([
                'uuid' => $sessionId,
                'account_id' => $account->id,
                'company_id' => $company->id,
                'user_id' => $userId,
                'name' => $request->input('name'),
                'phone' => $request->input('phone'),
                'address' => $request->input('address'),
                'notes' => $request->input('notes'),
                'payment_method' => $request->input('payment_method'),
                'total' =>  collect($cartItems)->sum('total'),
                'status' => 'pending',
            ]);

            $user->update([
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
            ]);

            foreach ($cartItems as $item) {
                // Retrieve the product to get price and other details
                $product = Product::where('id',$item['product_id'])->first();

                // Create an order item for each cart item
                OrderItem::create([
                    'user_id' => $userId,
                    'order_id' => $order->id,
                    'product_id' => $product->id,
                    'item' => $product->name,
                    'qty' => $item['qty'],
                    'price' => $item['price'],
                    'total' => $item['total'],
                    'shop_id' => $product->shop_id
                ]);
            }

            //create order log if Authenticated user is found
            $userId ? self::orderLog($order->id, $userId, $order->notes) : '';

            // Optionally, clear the cart after order is placed
            Cart::where('session_id', $sessionId)->delete();

            // Notify the user via both email and database
            if (env('APP_ENV') !== 'local') {
                auth()->user()->notify(new OrderPlacedNotification($order));
            }

            // Commit the transaction
            DB::commit();

            // Regenerate the session ID to ensure a unique UUID for each order
            session()->regenerate();

            if($apiResponse){
                return response()->json([
                    'status' => 200,
                    'session_id' =>  session()->getId(),
                    'message' => 'Order placed successfully!',
                    'data' => [
                        'order' =>  $order
                    ]
                ]);
            }else{
                return redirect()->route('account.order')->with('success', 'Order placed successfully!');
            }

        } catch (\Exception $e) {

            // Rollback transaction if something goes wrong
            DB::rollBack();

            // Log the exception details
            Log::error('Order placement failed: ' . $e->getMessage(), [
                'exception' => $e,
                'session_id' => $sessionId, // Optionally log additional context
            ]);

            // Return an error response
            if($apiResponse){
                return response()->json([
                    'status' => 500,
                    'message' => 'Errors : ' . $e->getMessage(),
                ]);
            }else{
                return redirect()->back()->withErrors('An error occurred while placing the order. Please try again.');
            }
            
        }
    }

    public static function orderLog($orderId, $userId, $note = null)
    {

        OrderLog::create([
            'user_id' => $userId,
            'order_id' => $orderId,
            'status' => 'pending',
            'note' => $note,
        ]);

        return true;
    }
}
