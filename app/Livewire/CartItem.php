<?php

namespace App\Livewire;

use Illuminate\Http\Request;
use App\Http\Controllers\Frontend\CartController;
use Livewire\Component;
use App\Models\Cart;
use App\Models\Product;

class CartItem extends Component
{   
    public $cartItems;
    public $serviceFee = 0;
    public $itemSubtotal = 0;
    public $totalAmount = 0;

    public $sidePanel = true;

    public function mount($sidePanel = true)
    {
        $this->sidePanel = $sidePanel;
        $this->getCartItems();
    }

    public function render()
    {
        return view('livewire.cart-item');
    }

    public function getCartItems()
    {
        $sessionId = session()->getId();
        $this->cartItems = Cart::with('product')->where('session_id', $sessionId)->get();
        $this->getSubtotal();
    }

    public function getSubtotal(){
        $this->itemSubtotal = collect($this->cartItems)->sum('total');
        $this->totalAmount = $this->itemSubtotal + $this->serviceFee;
    }

    public function reamoveCartItem($item)
    {
        Cart::find($item)->delete();
        $this->getCartItems();
        session()->flash('message', 'Cart Item removed');
    }

    public function updateCartQty(Cart $cart, $operator, Product $product){

        if($operator == 'substract' && $cart->qty == 1){
            $cart->delete();
            $this->getCartItems();
            session()->flash('message', 'Item Removed from cart');

            return;
        }

        $cartController = new CartController();
        $request = Request::create('/add-to-cart', 'POST', [
            'product_id' => $product->id,
            'qty' => ($operator == 'add') ? 1 : -1,  
        ]);

        $cartController->addToCart($request);
        $this->getCartItems();
        session()->flash('message', 'Cart has been updated');
    }
}
