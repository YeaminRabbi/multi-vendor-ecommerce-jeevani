<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CheckController extends Controller
{
    public function checkout(){
        $sessionId = session()->getId();
        $cartItems = Cart::with('product')->where('session_id', $sessionId)->get();
        
        $serviceFee = 0;
        $itemSubtotal = collect($cartItems)->sum('total');
        $totalAmount = $itemSubtotal + $serviceFee;

        return view('frontend.pages.checkout', compact('cartItems', 'serviceFee', 'itemSubtotal', 'totalAmount'));
    }
}
