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
                            <h2 class="mb-6">Your Orders</h2>

                            <div class="table-responsive-xxl border-0">
                                <!-- Table -->
                                <table class="table mb-0 text-nowrap table-centered">
                                    <!-- Table Head -->
                                    <thead class="bg-light">
                                        <tr>
                                            <th>SL</th>
                                            <th>Order</th>
                                            <th>Date</th>
                                            <th>Items</th>
                                            <th>Status</th>
                                            <th>Amount</th>

                                            <th></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($orders)
                                            @foreach ($orders as $key => $order)
                                                <tr>
                                                    <td>{{$key + 1}}</td>
                                                    <td class="align-middle border-top-0">
                                                        <a href="{{route('account.order.items', ['order' => $order])}}" class="text-inherit">#{{$order->id}}</a>
                                                    </td>
                                                    <td class="align-middle border-top-0">{{ date('d M, Y', strtotime($order->created_at))}}</td>
                                                    <td class="align-middle border-top-0">{{$order->items()->count()}}</td>
                                                    <td class="align-middle border-top-0">
                                                        <span class="badge bg-warning">{{$order->status}}</span>
                                                    </td>
                                                    <td class="align-middle border-top-0">{{number_format($order->total)}} ৳</td>
                                                    <td class="text-muted align-middle border-top-0">
                                                        <a href="{{route('account.order.items', ['order' => $order])}}" class="text-inherit" data-bs-toggle="tooltip"
                                                            data-bs-placement="top" data-bs-title="View"><i
                                                                class="feather-icon icon-eye"></i></a>
                                                    </td>
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
