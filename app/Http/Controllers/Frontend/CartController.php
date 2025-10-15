<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use App\Models\Product;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    public function cart(){
        return view('frontend.pages.cart');
    }

    public static function addToCart(Request $request, $redirectPage = false)
    {   
        $validatedData = $request->validate([
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|numeric',
        ]);

        // Get product details
        $product = Product::find($validatedData['product_id']);

        if(!$product){
            return response()->json([
                'status' => 404,
                'message' => 'Product not found!',
            ]);
        }
        
        $product_price = $product->discount_price; // validates the discount_to date and returns the actual price of product

        // Calculate the total price
        // $total = ($product->price - $product->discount + $product->vat) * $validatedData['qty'];
        $total = ($product_price + $product->vat) * $validatedData['qty'];
        
        // Handle session for guests or user_id for logged-in users
        $sessionId = $request->has('session_id') ? $request->session_id : session()->getId();
        $userId = auth()->check() ? auth()->id() : null;

        // Check if item already exists in the cart
        $cartItem = Cart::where('product_id', $product->id)
            ->where(function ($query) use ($sessionId, $userId) {
                if($userId){
                    $query->where('session_id', $sessionId)->orwhere('user_id', $userId);
                }
                else{
                    $query->where('session_id', $sessionId);
                }
            })
            ->first();

        if ($cartItem) {
            // If item exists, update the quantity and total
            $cartItem->qty += $validatedData['qty'];
            $cartItem->total = (($product_price + $product->vat) * $cartItem->qty);
            $cartItem->price = $product_price;
            $cartItem->discount = ($product->checkDiscountValidity() == 1) ? $product->discount : 0;
            $cartItem->save();
        } else {
            // Add new item to the cart
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'session_id' => $sessionId,
                'item' => $product->name, 
                'price' => $product_price,
                'discount' => ($product->checkDiscountValidity() == 1) ? $product->discount : 0, //adjusting the discount percentage
                'vat' => $product->vat,
                'qty' => $validatedData['qty'],
                'total' => $total,
                'note' => $request->input('note'),
                'is_active' => 1, 
            ]);
        }


        if ($redirectPage) {
            return back()->with('success', 'Product has been added to cart');
        }

        return response()->json([
            'status' => 200,
            'session_id' =>  $sessionId,
            'message' => 'Product added to cart successfully!',
        ]);
    }

    public static function getCartProduct(Request $request)
    {
        $sessionId = $request->has('session_id') ? $request->session_id : session()->getId();
        $userId = auth()->check() ? auth()->id() : null;

        $cartItems = Cart::where(function ($query) use ($sessionId, $userId) {
            if($userId){
                $query->where('session_id', $sessionId)->orwhere('user_id', $userId);
            }
            else{
                $query->where('session_id', $sessionId);
            }
        })->get();

        return response()->json([
            'status' => 200,
            'data' => [
                'cart_items' => CartResource::collection($cartItems),
            ],
        ]);
    }

    public function getCartProductCount(Request $request){
        $sessionId = $request->has('session_id') ? $request->session_id : session()->getId();
        $userId = auth()->check() ? auth()->id() : null;

        $cartItemsCount = Cart::where(function ($query) use ($sessionId, $userId) {
            if($userId){
                $query->where('session_id', $sessionId)->orwhere('user_id', $userId);
            }
            else{
                $query->where('session_id', $sessionId);
            }
        })->count();

        return response()->json([
            'status' => 200,
            'data' => [
                'cart_items_count' => $cartItemsCount
            ],
        ]);
    }

    public static function updateCartItem(Request $request, $id)
    {
        $validatedData = $request->validate([
            'qty' => 'required|numeric|min:1',
        ]);

        $cartItem = Cart::find($id);

        if(!$cartItem){
            return response()->json([
                'status' => 404,
                'message' => 'Cart item not found!',
            ]);
        }

        $product = $cartItem->product;

        if(!$product){
            return response()->json([
                'status' => 404,
                'message' => 'Product not found!',
            ]);
        }

        $product_price = $product->discount_price; // validates the discount_to date and returns the actual price of product

        // Calculate the total price
        $total = ($product_price + $product->vat) * $validatedData['qty'];

        $cartItem->qty = $validatedData['qty'];
        $cartItem->total = $total;
        $cartItem->price = $product_price;
        $cartItem->discount = ($product->checkDiscountValidity() == 1) ? $product->discount : 0;
        $cartItem->save();

        return response()->json([
            'status' => 200,
            'message' => 'Cart item updated successfully!',
            'data' => [
                'cart_item' => new CartResource($cartItem),
            ]
        ]);
    }

    public static function deleteCartItem(Request $request, $id)
    {
        $cartItem = Cart::find($id);

        if(!$cartItem){
            return response()->json([
                'status' => 404,
                'message' => 'Cart item not found!',
            ]);
        }

        $cartItem->delete();

        return response()->json([
            'status' => 200,
            'message' => 'Cart item deleted successfully!',
        ]);
    }
}
