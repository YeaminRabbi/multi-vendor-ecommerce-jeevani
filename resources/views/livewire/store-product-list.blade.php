<div>
    <div class="row">
        <div class="col-12 col-lg-3 col-md-4 mb-4 mb-md-0">
            <div class="d-flex flex-column">
                <div>
                    <!-- img -->
                    <img src="{{ asset($store->logo) }}" alt="{{ $store->slug }}"
                        class="rounded-circle icon-shape icon-xxl" />
                </div>
                <!-- heading -->
                <div class="mt-4">
                    <h1 class="mb-1 h4">{{ $store->name }}</h1>
                    <div class="small text-muted">
                        <span>Everyday store prices</span>
                    </div>
                    <div>
                        <span>
                            <small><a href="#!">100% satisfaction guarantee</a></small>
                        </span>
                    </div>
                    <!-- rating -->
                    <div class="mt-2">
                        <!-- rating -->
                        <small class="text-warning">
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-fill"></i>
                            <i class="bi bi-star-half"></i>
                        </small>
                        <span class="ms-2">5.0</span>
                        <!-- text -->
                        <span class="text-muted ms-1">(3,400 reviews)</span>
                    </div>
                </div>
            </div>
            <hr />
            <!-- nav -->
            <ul class="nav flex-column nav-pills nav-pills-dark">
                <!-- nav item -->
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="#">
                        <i class="feather-icon icon-shopping-bag me-2"></i>
                        Shop
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="feather-icon icon-gift me-2"></i>
                        Deals
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="feather-icon icon-map-pin me-2"></i>
                        Buy It Again
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="feather-icon icon-star me-2"></i>
                        Reviews
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="feather-icon icon-book me-2"></i>
                        Recipes
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="feather-icon icon-phone-call me-2"></i>
                        Contact
                    </a>
                </li>
                <!-- nav item -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="feather-icon icon-clipboard me-2"></i>
                        Policy
                    </a>
                </li>
            </ul>
            <hr />

            <div>
                <ul class="nav flex-column nav-links">
                    @if ($categories)
                        <li class="nav-item">
                            <a href="javascript:void(0);" class="nav-link" @click="$wire.searchProductByCategory([])">All Categories</a>
                        </li>
                        @foreach ($categories as $category)
                            <li class="nav-item">
                                <a href="javascript:void(0);" class="nav-link" @click="$wire.searchProductByCategory({{ $category->id }})">{{ $category->name }}</a>
                            </li>
                        @endforeach
                    @endif


                </ul>
            </div>
        </div>

        <div class="col-12 col-lg-9 col-md-8">
            @livewire('product-card-list', ['store' => $store])
        </div>
    </div>

</div>