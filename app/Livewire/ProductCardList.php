<?php

namespace App\Livewire;

use Livewire\Attributes\Reactive;
use Livewire\Component;
use App\Http\Controllers\Frontend\CartController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Shop;
use Livewire\Attributes\Url;

class ProductCardList extends Component
{
    public $products;
    public $searchProduct;

    #[Url(history: true)]
    public $category = '';

    public $searchProductQuery = null;
    public $shops;
    public $selectedCategory = null;
    public $searchShop = '';
    public $selectedShops = [];
    public $sortBy = 'default';
    public $perPage = 50;
    public $store = null;
    public $childrenCategoryIds = null;
    public $patientType = null;

    protected $listeners = [
        'searchProductByShop',
        'searchProductByCategory'
    ];

    public function mount($store = null, $query = null, $patientType = null)
    {
        if (request()->has('category') && !empty(request('category'))) {
            $category = Category::where('slug', request('category'))->first();
            if ($category) {
                $this->childrenCategoryIds = null;
                $this->selectedCategory = null;
        
                if ($category->children()->exists()) {
                    // Return 1 if the category has children
                    $this->childrenCategoryIds = $category->children()->pluck('id')->toArray();
                } else {
                    // Proceed with your category with no children
                    $this->selectedCategory = $category->id;
                }
            }
        }

        $this->store = $store;
        $this->searchProductQuery = $query;
        $this->patientType = $patientType;

        $this->products = Product::when($this->store !== null, function ($query) {
            return $query->where('shop_id', $this->store->id);
        })
            ->when($this->searchProductQuery !== null, function ($query) {
                return $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->searchProductQuery) . '%']);
            })
            ->when($this->selectedCategory !== null, function ($query) {
                return $query->where('category_id', $this->selectedCategory);
            })
            ->when($this->childrenCategoryIds !== null, function ($query) {
                return $query->whereIn('category_id', $this->childrenCategoryIds);
            })
            ->when($this->patientType !== null, function ($query) {
                return $query->whereJsonContains('patient_type', $this->patientType);
            })
            ->where('type', 'product')
            ->latest()
            ->active()
            ->get();
    }

    public function searchProductByCategory($categoryId)
    {

        $this->childrenCategoryIds = null;
        $this->selectedCategory = null;

        // Update the selected category
        $this->selectedCategory = !empty($categoryId) ? $categoryId : null;

        // Update the 'category' query parameter in the URL
        $this->category = Category::find($this->selectedCategory)->slug ?? null;

        // Re-filter the products
        $this->filterProducts();
    }

    public function searchProductByShop($shops)
    {
        $this->selectedShops = $shops;
        $this->filterProducts();
    }

    public function updatedSortBy()
    {
        $this->filterProducts();
    }

    public function updatedPerPage()
    {
        $this->filterProducts();
    }

    public function filterProducts()
    {
        $query = Product::when($this->store !== null, function ($query) {
            return $query->where('shop_id', $this->store->id);
        })->when($this->searchProductQuery !== null, function ($query) {
            return $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->searchProductQuery) . '%']);
        })
        ->when($this->patientType !== null, function ($query) {
            return $query->whereJsonContains('patient_type', $this->patientType);
        })
        ->active();

        if ($this->searchProduct) {
            $query->whereRaw('LOWER(name) LIKE ?', ['%' . strtolower($this->searchProduct) . '%']);
        }

        if ($this->selectedCategory) {
            $query->where('category_id', $this->selectedCategory);
        }

        if ($this->childrenCategoryIds) {
            $query->whereIn('category_id', $this->childrenCategoryIds);
        }

        if (count($this->selectedShops) > 0) {
            $query->whereIn('shop_id', $this->selectedShops);
        }

        if ($this->sortBy == 'Low_to_High') {
            $query->orderBy('price', 'ASC');
        } elseif ($this->sortBy == 'High_to_Low') {
            $query->orderBy('price', 'DESC');
        } elseif ($this->sortBy == 'default') {
            $query->orderBy('created_at', 'DESC');
        }

        $this->products = $query->where('type', 'product')->limit($this->perPage)->get();
    }

    public function addToCart($productId)
    {
        $cartController = new CartController();
        $request = Request::create('/add-to-cart', 'POST', [
            'product_id' => $productId,
            'qty' => 1,
        ]);
        $response = $cartController->addToCart($request);

        $response ? $this->dispatch('cart-updated-success') : $this->dispatch('cart-updated-warning');

        return true;
    }

    public function render()
    {
        return view('livewire.product-card-list');
    }
}
