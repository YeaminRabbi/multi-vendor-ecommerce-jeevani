@extends('frontend.layouts.master')

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <style>
        .star-rating .fa {
            font-size: 24px;
            cursor: pointer;
            color: #d3d3d3;
            /* Unselected star color */
        }

        .star-rating .fa:hover,
        .star-rating .fa.selected {
            color: #ffc107;
            /* Selected star color */
        }
    </style>
@endsection

@section('content')
    <main>
        <div class="mt-4">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <!-- breadcrumb -->
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item-homepage"><a href="{{ route('home') }}">Home / </a></li>
                                <li class="breadcrumb-item-product-category"><a
                                        href="#">&nbsp;{{ $product->category?->name }} / </a></li>

                                <li class="breadcrumb-item-product-name active" aria-current="page">
                                    &nbsp;{{ $product->name ?? null }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <section class="mt-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-5 col-xl-6">
                        <div class="slider slider-for">
                            @if ($product->media_urls)
                                @foreach ($product->media_urls as $item)
                                    <div>
                                        <div class="zoom" onmousemove="zoom(event)"
                                            style="background-image: url({{ asset($item) }})">
                                            <img src="{{ asset($item) }}" alt="Product Image" />
                                        </div>
                                    </div>
                                @endforeach
                            @endif



                        </div>
                        <div class="slider slider-nav mt-4">
                            @if ($product->media_urls)
                                @foreach ($product->media_urls as $item)
                                    <div>
                                        <img src="{{ asset($item) }}" alt="Product Image" class="w-100 rounded" />
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>

                    <div class="col-md-7 col-xl-6">
                        <div class="ps-lg-10 mt-6 mt-md-0">
                            <!-- content -->
                            <a href="#!" class="mb-4 d-block">{{ $product->category->name ?? null }}</a>
                            <!-- heading -->
                            <h1 class="mb-1">{{ $product->name ?? null }}</h1>
                            <div class="mb-4">
                                <!-- rating -->
                                <div class="mb-2">
                                    @php
                                        $avgRate = $product->avgRating();
                                    @endphp

                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($avgRate >= $i)
                                            <i class="bi bi-star-fill text-warning"></i>
                                            <!-- Full star -->
                                        @elseif ($avgRate > $i - 1)
                                            <i class="bi bi-star-half text-warning"></i>
                                            <!-- Half star -->
                                        @else
                                            <i class="bi bi-star text-muted"></i>
                                            <!-- Empty star -->
                                        @endif
                                    @endfor
                                    <a class="ms-2">({{$product->reviews()->count() ?? 0}} reviews)</a>
                                </div>
                            </div>
                            <div class="fs-4">
                                <!-- price -->
                                @if ($product->checkDiscountValidity())
                                    <span class="fw-bold text-dark">{{ $product->price }}৳</span>
                                    <span
                                        class="text-decoration-line-through text-muted">{{ $product->discount_price }}৳</span>
                                    <span><small class="fs-6 ms-2 text-danger">{{ $product->discount }}% Off</small></span>
                                @else
                                    <span class="fw-bold text-dark">{{ $product->price }}৳</span>
                                @endif
                            </div>
                            <!-- hr -->
                            <hr class="my-6" />
                            <form action="{{ route('cart.add', ['redirectPage' => true]) }}" method="POST">
                                @csrf
                                <input type="hidden" name="product_id" value="{{ $product->id }}">
                                <div>
                                    <div class="input-group input-spinner">
                                        <input type="button" value="-" class="button-minus btn btn-sm"
                                            data-field="qty" />

                                        <input type="number" step="1" max="10" value="1" name="qty"
                                            class="quantity-field form-control-sm form-input" />

                                        <input type="button" value="+" class="button-plus btn btn-sm"
                                            data-field="qty" />
                                    </div>
                                </div>
                                <div class="mt-3 row justify-content-start g-2 align-items-center">
                                    <div class="col-xxl-4 col-lg-4 col-md-5 col-5 d-grid">
                                        <!-- button -->
                                        <!-- btn -->
                                        <button type="submit" class="btn btn-primary">
                                            <i class="feather-icon icon-shopping-bag me-2"></i>
                                            Add to cart
                                        </button>
                                    </div>
                                </div>
                            </form>


                            <!-- hr -->
                            <hr class="my-6" />
                            <div>
                                <!-- table -->
                                <table class="table table-borderless mb-0">
                                    <tbody>
                                        <tr>
                                            <td>Product Code:</td>
                                            <td>{{ $product->sku }}</td>
                                        </tr>
                                        <tr>
                                            <td>Availability:</td>
                                            <td>{{ $product->is_in_stock == 1 ? 'In Stock' : 'Out of Stock' }}</td>
                                        </tr>
                                        <tr>
                                            <td>Type:</td>
                                            <td>{{ $product->type }}</td>
                                        </tr>
                                        <tr>
                                            <td>Shipping:</td>
                                            <td>{{ $product->is_shipped == 1 ? 'Yes' : 'No' }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="mt-8">
                                <!-- dropdown -->
                                <div class="dropdown">
                                    <a class="btn btn-outline-secondary dropdown-toggle" href="#" role="button"
                                        data-bs-toggle="dropdown" aria-expanded="false">Share</a>

                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-facebook me-2"></i>
                                                Facebook
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-twitter me-2"></i>
                                                Twitter
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="#">
                                                <i class="bi bi-instagram me-2"></i>
                                                Instagram
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section class="mt-lg-14 mt-8">
            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <ul class="nav nav-pills nav-lb-tab" id="myTab" role="tablist">
                            <!-- nav item -->
                            <li class="nav-item" role="presentation">
                                <!-- btn -->
                                <button class="nav-link active" id="product-tab" data-bs-toggle="tab"
                                    data-bs-target="#product-tab-pane" type="button" role="tab"
                                    aria-controls="product-tab-pane" aria-selected="true">
                                    Product Details
                                </button>
                            </li>
                            <!-- nav item -->
                            <li class="nav-item" role="presentation">
                                <!-- btn -->
                                <button class="nav-link " id="reviews-tab" data-bs-toggle="tab"
                                    data-bs-target="#reviews-tab-pane" type="button" role="tab"
                                    aria-controls="reviews-tab-pane" aria-selected="false">
                                    Reviews
                                </button>
                            </li>

                        </ul>
                        <!-- tab content -->
                        <div class="tab-content" id="myTabContent">
                            <!-- tab pane -->
                            <div class="tab-pane fade show active" id="product-tab-pane" role="tabpanel"
                                aria-labelledby="product-tab" tabindex="0">
                                <div class="my-8">
                                    {!! $product->details !!}
                                </div>
                            </div>
                            <!-- tab pane -->
                            <div class="tab-pane fade" id="reviews-tab-pane" role="tabpanel"
                                aria-labelledby="reviews-tab" tabindex="0">
                                <div class="my-8">
                                    <!-- row -->
                                    <div class="row">
                                        <!-- col -->
                                        <div class="col-md-12">

                                            @if (!empty($product->reviews))
                                                <div class="mb-10">
                                                    @foreach ($product->reviews->reverse() as $review)
                                                        <div class="d-flex border-bottom pb-6 mb-6">
                                                            <div class="ms-5">
                                                                <h6 class="mb-1">{{ $review->account->name }}</h6>
                                                                <p class="small">
                                                                    <span
                                                                        class="text-muted">{{ $review->created_at->format('d F Y') }}</span>
                                                                </p>
                                                                <div class="mb-2">
                                                                    @php
                                                                        $rate = $review->rate;
                                                                    @endphp

                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($rate >= $i)
                                                                            <i class="bi bi-star-fill text-warning"></i>
                                                                            <!-- Full star -->
                                                                        @elseif ($rate > $i - 1)
                                                                            <i class="bi bi-star-half text-warning"></i>
                                                                            <!-- Half star -->
                                                                        @else
                                                                            <i class="bi bi-star text-muted"></i>
                                                                            <!-- Empty star -->
                                                                        @endif
                                                                    @endfor
                                                                </div>
                                                                <p>
                                                                    {{ $review->review }}
                                                                </p>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                            @if (Auth::check())
                                                <div>
                                                    <!-- rating -->
                                                    <h3 class="mb-5">Share Your Thoughts!</h3>

                                                    <form
                                                        action="{{ route('store.review', ['product' => $product->id]) }}"
                                                        method="POST">
                                                        @csrf
                                                        <!-- star rating control -->
                                                        <div class="border-bottom py-4 mb-4">
                                                            <h5>Rate this product</h5>
                                                            <div class="star-rating">
                                                                <span class="fa fa-star" data-rating="1"></span>
                                                                <span class="fa fa-star" data-rating="2"></span>
                                                                <span class="fa fa-star" data-rating="3"></span>
                                                                <span class="fa fa-star" data-rating="4"></span>
                                                                <span class="fa fa-star" data-rating="5"></span>
                                                            </div>
                                                            <input type="hidden" name="rating" id="rating"
                                                                value="0">
                                                        </div>

                                                        <div class="py-4 mb-4">
                                                            <!-- heading -->
                                                            <h5>Add a written review</h5>
                                                            <textarea class="form-control" rows="3"
                                                                placeholder="What did you like or dislike? What did you use this product for?" name="review" required></textarea>
                                                        </div>
                                                        <!-- button -->
                                                        <div class="d-flex justify-content-end">
                                                            <button type="submit" class="btn btn-primary">Submit
                                                                Review</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            @else
                                                <div class="alert alert-warning">
                                                    <p>You need to be an authenticated user to submit a review.
                                                        <a href="{{ url('/login') }}">Log in here</a>.
                                                    </p>
                                                </div>
                                            @endif

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- section -->
        @if ($related_products->count() > 0)
            <section class="my-lg-14 my-14">
                <div class="container">
                    <!-- row -->
                    <div class="row">
                        <div class="col-12">
                            <!-- heading -->
                            <h3>Related Items</h3>
                        </div>
                    </div>
                    <!-- row -->
                    <div class="row g-4 row-cols-lg-5 row-cols-2 row-cols-md-2 mt-2">
                        <!-- col -->

                        @foreach ($related_products as $product)
                            <div class="col">
                                <!-- card -->
                                <div class="card card-product">
                                    <div class="card-body">
                                        <!-- badge -->
                                        <div class="text-center position-relative">
                                            <a href="{{ route('shop.single', ['slug' => $product->slug]) }}">
                                                <img src="{{ asset($product->featured_image_url) }}" alt="Product Image"
                                                    class="mb-3 img-fluid" />
                                            </a>
                                        </div>

                                        <!-- heading -->
                                        <div class="text-small mb-1">
                                            <a href="#!"
                                                class="text-decoration-none text-muted"><small>{{ $product->category?->name }}</small></a>
                                        </div>
                                        <h2 class="fs-6"><a href="shop-single.html"
                                                class="text-inherit text-decoration-none">{{ $product->name }}</a>
                                        </h2>

                                        <!-- price -->
                                        <div class="d-flex justify-content-between align-items-center mt-3">
                                            <div>
                                                @if ($product->checkDiscountValidity())
                                                    <span class="text-dark">{{ $product->discount_price }}৳</span>
                                                    <span
                                                        class="text-decoration-line-through text-muted">{{ $product->price }}৳</span>
                                                @else
                                                    <span class="text-dark">{{ $product->discount_price }}৳</span>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach

                    </div>
                </div>
            </section>
        @endif
    </main>
@endsection

@section('js')
    @include('frontend.layouts.includes.scripts.non-parent-component-cart-alert')

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const stars = document.querySelectorAll('.star-rating .fa');
            const ratingInput = document.getElementById('rating');

            stars.forEach(star => {
                star.addEventListener('click', function() {
                    let rating = this.getAttribute('data-rating');
                    ratingInput.value = rating;

                    stars.forEach(s => {
                        s.classList.remove('selected');
                    });

                    for (let i = 0; i < rating; i++) {
                        stars[i].classList.add('selected');
                    }
                });
            });
        });
    </script>
@endsection
