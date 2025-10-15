@extends('frontend.layouts.master')

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
                                <li class="breadcrumb-item-home"><a href="{{ route('home') }}">Home /</a></li>
                                <li class="breadcrumb-item-store"><a href="#!">&nbsp;Store </a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <section class="mt-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <!-- heading -->
                        <div class="bg-light d-flex justify-content-between ps-md-10 ps-6 rounded">
                            <div class="d-flex align-items-center">
                                <h1 class="mb-0 fw-bold">Stores</h1>
                            </div>
                            <div class="py-6">
                                <!-- img -->
                                <!-- img -->
                                <img src="{{ asset('frontend_asset/images/svg-graphics/store-graphics.svg') }}"
                                    alt="Store Image" class="img-fluid" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- section -->
        <section class="mt-8 mb-lg-14 mb-8">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="mb-3">
                            <!-- text -->
                            <h6>
                                We have
                                <span class="text-primary">{{ $stores->count() }}</span>
                                stores now
                            </h6>
                        </div>
                    </div>
                </div>

                <div class="row row-cols-1 row-cols-lg-4 row-cols-md-3 g-4 g-lg-4">
                    @if ($stores)
                        @foreach ($stores as $store)
                            <div class="col">
                                <div class="card p-6 card-product">
                                    <div>
                                        <img src="{{ $FrontendHelper::filePath($store->logo) }}"
                                            alt="{{$store->slug}}" class="rounded-circle icon-shape icon-xl" />
                                    </div>
                                    <div class="mt-4">
                                        <h2 class="mb-1 h5"><a href="{{route('store.single', $store->slug)}}" class="text-inherit">{{$store->name}}</a></h2>
                                        <div class="small text-muted">
                                            <span class="me-2">Organic</span>
                                            <span class="me-2">Groceries</span>
                                            <span class="me-2">Butcher Shop</span>
                                        </div>
                                        <div class="py-3">
                                            <ul class="list-unstyled mb-0 small">
                                                <li>Delivery</li>
                                                <li>Pickup available</li>
                                            </ul>
                                        </div>
                                        <div>
                                            <div class="badge text-bg-light border">7.5 mi away</div>
                                            <div class="badge text-bg-light border">In-store prices</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </section>
    </main>
@endsection
