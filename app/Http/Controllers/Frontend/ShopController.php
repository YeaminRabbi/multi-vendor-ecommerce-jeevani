<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Media;

class ShopController extends Controller
{
    public function shop()
    {
        return view('frontend.pages.shop.list');
    }

    public function shopSingle($slug = null)
    {
        if (!$slug) {
            // Handle the case where slug is missing or invalid
            abort(404, 'Product not found');
        }

        // Fetch product based on the slug, assuming you have a Product model
        $product = Product::with('reviews.account')->where('slug', $slug)->firstOrFail();
        $related_products = Product::where('category_id', $product->category_id)
        ->where('id', '!=', $product->id) // Exclude the current product
        ->get();

        return view('frontend.pages.shop.single', compact('product','related_products'));
    }
}
