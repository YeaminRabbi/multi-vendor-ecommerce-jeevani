<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Shop;

class StoreController extends Controller
{
    public function store(){
        $stores = Shop::with('product.categories')->latest()->get();
        return view('frontend.pages.store.list',compact('stores'));
    }

    public function storeSingle($slug = null){

        if (!$slug) {
            abort(404, 'Store not found');
        }

        $store = Shop::where('slug', $slug)->firstOrFail();

        return view('frontend.pages.store.single', compact('store'));
    }
}
