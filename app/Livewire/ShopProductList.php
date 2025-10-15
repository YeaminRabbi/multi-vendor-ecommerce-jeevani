<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;


class ShopProductList extends Component
{
    public $categories;
    public $shops;
    public $selectedCategory = null;
    public $searchShop = ''; 
    public $selectedShops = [];
   
    public function mount()
    {
        $this->shops = Shop::get();
        $this->categories = Category::whereNull('parent_id')->get();
    }
   
    public function filterShops()
    {
        $this->shops = Shop::where('name', 'like', '%' . $this->searchShop . '%')->get();
    }

    public function searchProductByShop()
    {
        $this->dispatch('searchProductByShop', $this->selectedShops);
    }

    public function searchProductByCategory($categoryId)
    {
        $this->selectedCategory = $categoryId;
        $this->dispatch('searchProductByCategory', $this->selectedCategory);
    }

    public function render()
    {
        return view('livewire.shop-product-list');
    }
}
