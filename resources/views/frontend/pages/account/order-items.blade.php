@extends('frontend.layouts.master')

@section('content')
    <main>
        <!-- section -->
        <section>
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <!-- heading -->
                            <h3 class="fs-5 mb-0">Account Setting</h3>
                            <!-- button -->
                            <button class="btn btn-outline-gray-400 text-muted d-md-none btn-icon btn-sm ms-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount" aria-controls="offcanvasAccount">
                                <i class="bi bi-text-indent-left fs-3"></i>
                            </button>
                        </div>
                    </div>
                    <!-- col -->
                    <div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
                       @include('frontend.layouts.includes.account-sidebar')
                    </div>
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 p-md-6 p-lg-10">
                            <!-- heading -->
                            <div class="d-flex justify-content-between">
                                <h2 class="mb-6">Items Orders</h2>
                                <div>
                                    <a href="{{route('account.order')}}" class="btn btn-primary">Back</a>
                                </div>
                            </div>

                            <div class="table-responsive-xxl border-0">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap table-centered">
                                    <!-- Table Head -->
                                    <thead class="bg-light">
                                        <tr>
                                            <th>SL</th>
                                            <th>Image</th>
                                            <th>Product</th>
                                            <th>Price</th>
                                            <th>Qty</th>
                                            <th>Amount</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($orderItems)
                                            @foreach ($orderItems as $key => $item)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td class="align-middle border-top-0 w-0">
                                                        <a href="{{route('shop.single', $item->product->id)}}"><img src="{{asset($item->product->featured_image_url)}}"
                                                                alt="{{$item->product->slug}}" class="icon-shape icon-xl" /></a>
                                                    </td>
                                                    <td class="align-middle border-top-0">
                                                        <a href="{{route('shop.single', $item->product->id)}}" class="fw-semibold text-inherit">
                                                            <h6 class="mb-0">{{$item->product->name}}</h6>
                                                        </a>
                                                    </td>
                                                    <td class="align-middle border-top-0">{{number_format($item->price)}} ৳</td>
                                                    <td class="align-middle border-top-0">{{$item->qty}}</td>
                                                    <td class="align-middle border-top-0">{{number_format($item->total)}} ৳</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
