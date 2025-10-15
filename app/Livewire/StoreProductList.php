<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Category;
use App\Models\Product;
use App\Models\Shop;

class StoreProductList extends Component
{
    public $store;
    public $products;
    public $categories;
    public $shops;
    public $selectedCategory = null;
    public $searchProduct = ''; 
    public $selectedShops = [];
    public $sortBy = 'default';
    public $perPage = 50; 

    public function mount($shop)
    {
        $this->store = $shop;
        $this->products = Product::where('shop_id', $this->store->id)->latest()->active()->get();

        $productIds = $this->products->pluck('id');
        $this->categories = Category::whereHas('products', function ($query) use ($productIds) {
            $query->whereIn('id', $productIds)->whereNotNull('parent_id');
        })->get();

    }

    public function searchProductByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->dispatch('searchProductByCategory', $this->selectedCategory);
    }

    public function render()
    {
        return view('livewire.store-product-list');
    }
}
