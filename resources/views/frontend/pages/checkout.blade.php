@extends('frontend.layouts.master')

@section('content')
    <main>
        <!-- section-->
        <div class="mt-4">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item-home"><a href="{{ route('home') }}">Home /</a></li>
                                <li class="breadcrumb-item-shop"><a href="#!">&nbsp; Shop</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <section class="mb-lg-14 mb-8 mt-8">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div>
                            <div class="mb-8">
                                <h1 class="fw-bold mb-0">Checkout</h1>
                                <p class="mb-0">
                                    Already have an account? Click here to
                                    <a href="{{ route('account.signup') }}">Sign in</a>
                                    .
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div>
                    <form action="{{route('order.place')}}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-xl-7 col-lg-6 col-md-12">
                                <div class="accordion accordion-flush" id="accordionFlushExample">
                                    <!-- accordion item | Address -->
                                    <div class="accordion-item py-4">
                                        <div class="d-flex justify-content-between align-items-center">
                                            <!-- heading one -->
                                            <a href="#" class="fs-5 text-inherit collapsed h4"
                                                data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                aria-expanded="true" aria-controls="flush-collapseOne">
                                                <i class="feather-icon icon-map-pin me-2 text-muted"></i>
                                                Add delivery info
                                            </a>
                                            <!-- btn -->
                                            <a href="#" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#addAddressModal">Add a new address</a>
                                            <!-- collapse -->
                                        </div>
                                        <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="mt-5">
                                                <div class="row">
                                                    <!-- Name Field -->
                                                    <div class="col-xl-12 col-lg-12 col-md-6 col-12 mb-4">
                                                        <label for="name" class="form-label sr-only">Name</label>
                                                        <input type="text" class="form-control" id="name" value="{{auth()->user()->name ?? ''}}" name="name" placeholder="Your Name" required>
                                                    </div>
                                                    
                                                    <!-- Phone Field -->
                                                    <div class="col-xl-12 col-lg-12 col-md-6 col-12 mb-4">
                                                        <label for="phone" class="form-label sr-only">Phone</label>
                                                        <input type="tel" class="form-control" id="phone" value="{{auth()->user()->phone ?? ''}}" name="phone" placeholder="Your Phone Number" required>
                                                    </div>
                                                    
                                                    <!-- Delivery Address Field -->
                                                    <div class="col-xl-12 col-lg-12 col-md-6 col-12 mb-4">
                                                        <label for="CustomDeliveryAddress" class="form-label sr-only">Delivery Address</label>
                                                        <textarea class="form-control" id="CustomDeliveryAddress" name="address" rows="3" placeholder="Write delivery address" required>{{auth()->user()->address ?? ''}}</textarea>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- accordion item | Delivery Instructions -->
                                    <div class="accordion-item py-4">
                                        <a href="#" class="text-inherit h5" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                                            aria-controls="flush-collapseThree">
                                            <i class="feather-icon icon-shopping-bag me-2 text-muted"></i>
                                            Delivery instructions
                                            <!-- collapse -->
                                        </a>
                                        <div id="flush-collapseThree" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="mt-5">
                                                <label for="DeliveryInstructions" class="form-label sr-only">Delivery
                                                    instructions</label>
                                                <textarea class="form-control" id="DeliveryInstructions" rows="3" placeholder="Write delivery instructions" name="notes" ></textarea>
                                                <p class="form-text">Add instructions for how you want your order shopped
                                                    and/or delivered</p>
                                                <div class="mt-5 d-flex justify-content-end">
                                                    <a href="#" class="btn btn-outline-gray-400 text-muted"
                                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne"
                                                        aria-expanded="false" aria-controls="flush-collapseOne">
                                                        Prev
                                                    </a>
                                                    <a href="#" class="btn btn-primary ms-2" data-bs-toggle="collapse"
                                                        data-bs-target="#flush-collapseFour" aria-expanded="false"
                                                        aria-controls="flush-collapseFour">
                                                        Next
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- accordion item | Paymen Method -->
                                    <div class="accordion-item py-4">
                                        <a href="#" class="text-inherit h5" data-bs-toggle="collapse"
                                            data-bs-target="#flush-collapseFour" aria-expanded="false"
                                            aria-controls="flush-collapseFour">
                                            <i class="feather-icon icon-credit-card me-2 text-muted"></i>
                                            Payment Method
                                            <!-- collapse -->
                                        </a>
                                        <div id="flush-collapseFour" class="accordion-collapse collapse"
                                            data-bs-parent="#accordionFlushExample">
                                            <div class="mt-5">
                                                <div>
                                                    <div class="card card-bordered shadow-none">
                                                        <div class="card-body p-6">
                                                            <!-- check input -->
                                                            <div class="d-flex">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="payment_method" id="cashonDelivery" value="cash" required/>
                                                                    <label class="form-check-label ms-2"
                                                                        for="cashonDelivery"></label>
                                                                </div>
                                                                <div>
                                                                    <!-- title -->
                                                                    <h5 class="mb-1 h6">Cash on Delivery</h5>
                                                                    <p class="mb-0 small">Pay with cash when your order is
                                                                        delivered.</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Button -->
                                                    <div class="mt-5 d-flex justify-content-end">
                                                        <a href="#" class="btn btn-outline-gray-400 text-muted"
                                                            data-bs-toggle="collapse"
                                                            data-bs-target="#flush-collapseThree" aria-expanded="false"
                                                            aria-controls="flush-collapseThree">
                                                            Prev
                                                        </a>
                                                        <button type="submit" class="btn btn-primary ms-2 {{$totalAmount <=0 ? 'disabled' : ''}}">Place Order</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12 offset-xl-1 col-xl-4 col-lg-6">
                                <div class="mt-4 mt-lg-0">
                                    <div class="card shadow-sm">
                                        <h5 class="px-6 py-4 bg-transparent mb-0">Order Details</h5>
                                        <ul class="list-group list-group-flush">
                                            @if ($cartItems)
                                                @foreach ($cartItems as $item)
                                                    <li class="list-group-item px-4 py-3">
                                                        <div class="row align-items-center">
                                                            <div class="col-2 col-md-2">
                                                                <img src="{{ asset($item->product->featured_image_url) }}"
                                                                    alt="Product Image" class="img-fluid" />
                                                            </div>
                                                            <div class="col-5 col-md-5">
                                                                <h6 class="mb-0">{{ $item->product->name }}</h6>
                                                            </div>
                                                            <div class="col-2 col-md-2 text-center text-muted">
                                                                <span>{{ $item->qty }}</span>
                                                            </div>
                                                            <div class="col-3 text-lg-end text-start text-md-end col-md-3">
                                                                <span
                                                                    class="fw-bold">{{ number_format($item->total) }}৳</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            @endif

                                            <!-- list group item -->
                                            <li class="list-group-item px-4 py-3">
                                                <div class="d-flex align-items-center justify-content-between mb-2">
                                                    <div>Item Subtotal</div>
                                                    <div class="fw-bold">{{ number_format($itemSubtotal) }}৳</div>
                                                </div>
                                                <div class="d-flex align-items-center justify-content-between">
                                                    <div>
                                                        Service Fee
                                                        <i class="feather-icon icon-info text-muted"
                                                            data-bs-toggle="tooltip" title="Default tooltip"></i>
                                                    </div>
                                                    <div class="fw-bold">{{ number_format($serviceFee) }}৳</div>
                                                </div>
                                            </li>
                                            <!-- list group item -->
                                            <li class="list-group-item px-4 py-3">
                                                <div class="d-flex align-items-center justify-content-between fw-bold">
                                                    <div>Subtotal</div>
                                                    <div>{{ number_format($totalAmount) }}৳</div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </section>
    </main>
@endsection
