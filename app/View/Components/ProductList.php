<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProductList extends Component
{
    public $product;
    public $parentComponent = false;

    public function __construct($product, $parentComponent = false)
    {
        $this->product = $product;
        $this->parentComponent = $parentComponent;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.product-list');
    }
}
