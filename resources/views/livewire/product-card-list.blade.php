<div>

    @if (!$searchProductQuery && !$patientType)
        <div class="mb-8 bg-light d-lg-flex justify-content-lg-between rounded">
            <div class="align-self-center p-8">
                <div class="mb-3">
                    <h5 class="mb-0 fw-bold">{{ $store ? $store->name : 'Shop' }}</h5>
                    <p class="mb-0 text-muted">Whatever the occasion, we've got you covered.</p>
                </div>
                <div class="position-relative">

                    <div class="position-relative">
                        <input type="search" class="form-control" placeholder="Search Product" wire:model="searchProduct"
                            wire:input="filterProducts" />
                    </div>
                </div>
            </div>
            <div class="py-4">
                <img src="{{ asset('frontend_asset/images/svg-graphics/store-graphics.svg') }}" alt="Shop"
                    class="img-fluid" />
            </div>
        </div>
    @endif


    <!-- list icon -->
    <div class="d-lg-flex justify-content-between align-items-center">
        <div class="mb-3 mb-lg-0">
            <p class="mb-0">
                <span class="text-dark">{{ $products->count() }}</span>
                Products found
            </p>
        </div>

        <!-- icon -->
        @if ($products->count() > 0) 
            <div class="d-md-flex justify-content-between align-items-center">
                <div class="d-flex align-items-center justify-content-between">
                    <div></div>
                    <div class="ms-2 d-lg-none">
                        <a class="btn btn-outline-gray-400 text-muted" data-bs-toggle="offcanvas"
                            href="#offcanvasCategory" role="button" aria-controls="offcanvasCategory">
                            <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-filter me-2">
                                <polygon points="22 3 2 3 10 12.46 10 19 14 21 14 12.46 22 3"></polygon>
                            </svg>
                            Filters
                        </a>
                    </div>
                </div>

                <div class="d-flex mt-2 mt-lg-0">
                    <div class="me-2 flex-grow-1">
                        <!-- Pagination per page select option -->
                        <select class="form-select" wire:model="perPage" wire:input="filterProducts">
                            <option value="10">10</option>
                            <option value="20">20</option>
                            <option value="30">30</option>
                            <option value="50" selected>50</option>
                        </select>
                    </div>
                    <div>
                        <!-- Sorting select option -->
                        <select class="form-select" wire:model="sortBy" wire:input="filterProducts">
                            <option value="default" selected>Sort by: Default</option>
                            <option value="Low_to_High">Price: Low to High</option>
                            <option value="High_to_Low">Price: High to Low</option>
                        </select>

                    </div>
                </div>
            </div>
        @endif
    </div>

    <div class="row g-4 row-cols-xl-4 row-cols-lg-3 row-cols-2 row-cols-md-2 mt-2">
        @if ($products)
            @foreach ($products as $product)
                <x-product-list :product="$product" />
            @endforeach
        @endif
    </div>
</div>
