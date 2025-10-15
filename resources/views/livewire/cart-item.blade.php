<div class="row">
    <div class="{{!$sidePanel ? 'col-md-12' : 'col-lg-8 col-md-7'}}">
        <div class="py-3">
            <ul class="list-group list-group-flush">
                @if ($cartItems)
                    @foreach ($cartItems as $item)
                        <li class="list-group-item py-3 ps-0 border-top">
                            <!-- row -->
                            <div class="row align-items-center">
                                <div class="col-6 col-md-6 col-lg-7">
                                    <div class="d-flex">
                                        <img src="{{ asset($item->product->featured_image_url) }}" alt="Ecommerce"
                                             class="icon-shape icon-xxl"/>
                                        <div class="ms-3">
                                            <!-- title -->
                                            <a href="{{ route('shop.single', $item->product->slug) }}"
                                               class="text-inherit">
                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                            </a>
                                            <!-- text -->
                                            <div class="mt-2 small lh-1">
                                                <a wire:click="reamoveCartItem({{ $item->id }})"
                                                   class="text-decoration-none text-inherit" style="cursor: pointer;">
                                                    <span class="me-1 align-text-bottom">
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="14"
                                                             height="14" viewBox="0 0 24 24" fill="none"
                                                             stroke="currentColor" stroke-width="2"
                                                             stroke-linecap="round"
                                                             stroke-linejoin="round"
                                                             class="feather feather-trash-2 text-success">
                                                            <polyline points="3 6 5 6 21 6"></polyline>
                                                            <path
                                                                d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2">
                                                            </path>
                                                            <line x1="10" y1="11" x2="10"
                                                                  y2="17"></line>
                                                            <line x1="14" y1="11" x2="14"
                                                                  y2="17"></line>
                                                        </svg>
                                                    </span>
                                                    <span class="text-muted">Remove</span>
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- input group -->
                                <div class="col-4 col-md-4 col-lg-3">
                                    <!-- input -->
                                    <!-- input -->
                                    <div class="input-group input-spinner">
                                        <input type="button" value="-" class="button-minus btn btn-sm"
                                               data-field="quantity"
                                               wire:click="updateCartQty({{$item->id}}, 'substract', {{$item->product}})"/>
                                        <input type="number" step="1" max="10" value="{{ $item->qty }}"
                                               name="quantity" class="quantity-field form-control-sm form-input"/>
                                        <input type="button" value="+" class="button-plus btn btn-sm"
                                               data-field="quantity"
                                               wire:click="updateCartQty({{$item->id}}, 'add', {{$item->product}})"/>
                                    </div>
                                </div>
                                <!-- price -->
                                <div class="col-2 text-lg-end text-start text-md-end col-md-2">
                                    <span class="fw-bold">{{ number_format($item->total) }}৳</span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                @endif
            </ul>
            <!-- btn -->
            <div class="d-flex justify-content-between mt-4">
                <a href="{{route('shop.list')}}" class="btn btn-primary">Continue Shopping</a>

                @if ($cartItems->count() > 0 && $sidePanel)
                    <a href="{{ route('cart') }}" class="btn btn-dark">Update Cart</a>
                @endif

                @if ($cartItems->count() > 0 && !$sidePanel )
                    <a href="{{route('checkout')}}" class="btn btn-primary">Go to Checkout</a>
                @endif
            </div>
        </div>

    </div>

    <!-- cart sidebar -->
    <div class="col-12 col-lg-4 col-md-5" x-data="{ sidePanel: @json($sidePanel) }">
        <!-- card -->
        <div class="mb-5 card mt-6" x-show="sidePanel">
            <div class="card-body p-6">
                <!-- heading -->
                <h2 class="h5 mb-4">Summary</h2>
                <div class="card mb-2">
                    <!-- list group -->
                    <ul class="list-group list-group-flush">
                        <!-- list group item -->
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div>Item Subtotal</div>
                            </div>
                            <span>{{number_format($itemSubtotal)}}৳</span>
                        </li>

                        <!-- list group item -->
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div>Service Fee</div>
                            </div>
                            <span>{{number_format($serviceFee)}}৳</span>
                        </li>
                        <!-- list group item -->
                        <li class="list-group-item d-flex justify-content-between align-items-start">
                            <div class="me-auto">
                                <div class="fw-bold">Subtotal</div>
                            </div>
                            <span class="fw-bold">{{number_format($totalAmount)}}৳</span>
                        </li>
                    </ul>
                </div>
                <div class="d-grid mb-1 mt-4">
                    <!-- btn -->
                    <a href="{{ (\App\Helpers\Frontend::authCheckoutProcess() && Auth::check()) ? route('checkout') : route('login')}}"
                       class="btn btn-primary btn-lg d-flex justify-content-between align-items-center {{ $totalAmount <=0 ? 'disabled' : ''}}"
                       type="submit">
                        Go to Checkout
                        <span class="fw-bold">{{ number_format($totalAmount) }}৳</span>
                    </a>
                </div>
                <!-- text -->
                <p>
                    <small>
                        By placing your order, you agree to be bound by the Freshcart
                        <a href="#!">Terms of Service</a>
                        and
                        <a href="#!">Privacy Policy.</a>
                    </small>
                </p>
            </div>
        </div>
    </div>
</div>
