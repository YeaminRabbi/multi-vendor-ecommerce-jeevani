<div class="row gx-10">
    <aside class="col-lg-3 col-md-4 mb-6 mb-md-0">
        <div class="offcanvas offcanvas-start offcanvas-collapse w-md-50" tabindex="-1" id="offcanvasCategory"
            aria-labelledby="offcanvasCategoryLabel">
            <div class="offcanvas-header d-lg-none">
                <h5 class="offcanvas-title" id="offcanvasCategoryLabel">Filter</h5>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body ps-lg-2 pt-lg-0">
                <!-- Category -->
                <div class="mb-8">
                    <h5 class="mb-3">Categories</h5>
                    <ul class="nav nav-category" id="categoryCollapseMenu">
                        @if ($categories)
                            <li class="nav-item border-bottom w-100">
                                <a href="javascript:void(0);" class="nav-link collapsed"
                                    @click="$wire.searchProductByCategory([])">
                                    All Categories
                                </a>
                            </li>
                            @foreach ($categories as $key => $category)
                                <li class="nav-item border-bottom w-100" x-data="{ isOpen: false, hasChildren: {{ $category->children->count() > 0 ? 'true' : 'false' }} }">
                                    <a href="javascript:void(0);" class="nav-link collapsed"
                                        @click="if (!hasChildren) { $wire.searchProductByCategory({{ $category->id }}); } else { isOpen = !isOpen }"
                                        :aria-expanded="isOpen.toString()"
                                        aria-controls="categoryFlushOne-{{ $key }}">
                                        {{ $category->name }}
                                        <i class="feather-icon icon-chevron-right" x-show="hasChildren"></i>
                                    </a>

                                    <!-- Dropdown Menu for Child Categories -->
                                    <div id="categoryFlushOne-{{ $key }}" class="accordion-collapse collapse"
                                        x-bind:class="{ 'show': isOpen }" x-cloak>
                                        <div>
                                            <ul class="nav flex-column ms-3">
                                                @foreach ($category->children as $childCategory)
                                                    <li class="nav-item">
                                                        <a href="javascript:void(0);" class="nav-link"
                                                            @click="$wire.searchProductByCategory({{ $childCategory->id }})">
                                                            {{ $childCategory->name }}
                                                        </a>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        @endif
                    </ul>
                </div>

                <!-- Shop -->
                <div class="mb-8">
                    <h5 class="mb-3">Shop</h5>
                    <div class="my-4">
                        <input type="search" class="form-control" placeholder="Search by shop" wire:model="searchShop"
                            wire:input="filterShops" />
                    </div>


                    @if ($shops)
                        @foreach ($shops as $shop)
                            <div class="form-check mb-2">
                                <input class="form-check-input" type="checkbox" value="{{ $shop->id }}"
                                    wire:model="selectedShops" wire:input="searchProductByShop"
                                    id="shop-{{ $shop->id }}" />
                                <label class="form-check-label"
                                    for="shop-{{ $shop->id }}">{{ $shop->name }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </aside>

    <section class="col-lg-9 col-md-12">
        @livewire('product-card-list')
    </section>
</div>