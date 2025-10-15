<?php
$categoryProducts = \App\Models\Category::with('categoryProducts')->where('for', 'product')
    ->where([
        'type' => 'category',
        'for' => 'product',
        'is_active'=> 1,
        'show_in_menu' => 1
    ])->get();
?>
<section>
    <div class="container">
        @foreach($categoryProducts as $category)
            <div class="row">
                <div class="col-md-12 mb-6">
                    <h3 class="mb-0">{{$category->name}}</h3>
                </div>
            </div>

            <div class="table-responsive-lg pb-6">
                <div class="row row-cols-lg-4 row-cols-1 row-cols-md-2 g-4">
                    @foreach($category->categoryProducts as $product)
                        <x-product-list :product="$product" :parentComponent=true />
                    @endforeach
                </div>
            </div>

        @endforeach
    </div>
</section>

