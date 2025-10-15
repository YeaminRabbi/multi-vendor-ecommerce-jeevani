<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 mb-6">
                <h3 class="mb-0">Most Trending Products</h3>
            </div>
        </div>
        <div class="table-responsive-lg pb-6">
            <div class="row row-cols-lg-4 row-cols-1 row-cols-md-2 g-4">

{{--                <x-trending-products></x-trending-products>--}}

                @if ($trendingProducts)
                    @foreach($trendingProducts as $product)
                        <x-product-list :product="$product" :parentComponent=true />
                    @endforeach
                @endif

            </div>
        </div>
    </div>
</section>
