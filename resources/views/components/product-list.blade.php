<div class="col">
    <!-- card -->
    <div class="card card-product">
        <div class="card-body">
            <!-- badge -->
            <div class="text-center position-relative">
                <a href="{{ route('shop.single', ['slug' => $product->slug]) }}">
                    <img src="{{ asset($product->featured_image_url) }}" alt="Product Image" class="mb-3 img-fluid" />
                </a>
            </div>

            <!-- heading -->
            <div class="text-small mb-1">
                <a href="#"
                    class="text-decoration-none text-muted"><small>{{ $product->category->name ?? '' }}</small></a>
            </div>
            <h2 class="fs-6"><a href="{{ route('shop.single', ['slug' => $product->slug]) }}"
                    class="text-inherit text-decoration-none">{{ $product->name ?? '' }}</a>
            </h2>

            <div class="d-flex justify-content-between align-items-center mt-3">
                <div>
                    @if ($product->checkDiscountValidity())
                        <span class="text-dark">{{ number_format($product->discount_price) }}৳</span>
                        <span
                            class="text-decoration-line-through text-muted">{{ number_format($product->price) }}৳</span>
                    @else
                        <span class="text-dark">{{ number_format($product->discount_price) }}৳</span>
                    @endif
                </div>
                <div>
                    @if (!$parentComponent)
                        <button wire:click="addToCart({{ $product->id }})" class="btn btn-primary btn-sm">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-plus">
                                <line x1="12" y1="5" x2="12" y2="19">
                                </line>
                                <line x1="5" y1="12" x2="19" y2="12">
                                </line>
                            </svg>
                            Add
                        </button>
                    @else
                        <form action="{{ route('cart.add', ['redirectPage' => true]) }}" method="POST">
                            @csrf
                            <input type="hidden" name="product_id" value="{{ $product->id }}">
                            <input type="hidden" value="1" name="qty"/>
                            <button type="submit" class="btn btn-primary btn-sm">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round" class="feather feather-plus">
                                    <line x1="12" y1="5" x2="12" y2="19">
                                    </line>
                                    <line x1="5" y1="12" x2="19" y2="12">
                                    </line>
                                </svg>
                                Add
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
