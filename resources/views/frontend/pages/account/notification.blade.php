{{-- @extends('frontend.layouts.master')

@section('content')
    <main>
        <!-- section -->
        <section class="bg-light py-5">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <!-- heading -->
                            <h3 class="fs-4 fw-bold mb-0">Account Settings</h3>
                            <!-- button -->
                            <button class="btn btn-outline-secondary btn-icon btn-sm ms-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount" aria-controls="offcanvasAccount">
                                <i class="bi bi-list fs-3"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
                        @include('frontend.layouts.includes.account-sidebar')
                    </div>

                    <!-- Notifications -->
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 px-md-6 px-lg-10">
                            <div class="mb-10">
                                <div class="border-bottom pb-3 mb-5">
                                    <h2 class="fw-bold">Notifications</h2>
                                </div>

                                @if ($notifications)
                                    @foreach ($notifications as $notification)
                                        <!-- Notification Card -->
                                        <div class="card mb-4 shadow-sm">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1 text-dark">
                                                        <i class="bi bi-box-seam me-2"></i>
                                                        Order #{{ $notification->data['order_id'] }}
                                                    </h6>
                                                    <p class="mb-0 text-muted small">
                                                        Placed on: {{ \Carbon\Carbon::parse($notification->created_at)->format('M d, Y') }}
                                                    </p>
                                                </div>

                                                <div class="text-end">
                                                    <span class="badge bg-success fs-6">৳{{ $notification->data['order_total'] }}</span>
                                                    <a href="{{ $notification->data['url'] }}" class="btn btn-sm btn-outline-primary ms-3">
                                                        View Order <i class="bi bi-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">
                                        No notifications available.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection --}}


@extends('frontend.layouts.master')

@section('styles')
    <style>
        /* Unread notifications (lighter background) */
        .card.bg-light {
            background-color: #f8f9fa;
        }

        /* Read notifications (white background) */
        .card.bg-white {
            background-color: #ffffff;
        }

        /* You can add hover effects if needed */
        .card:hover {
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
@endsection

@section('content')
    <main>
        <!-- section -->
        <section class="bg-light py-5">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row">
                    <!-- col -->
                    <div class="col-12">
                        <div class="d-flex justify-content-between align-items-center d-md-none py-4">
                            <!-- heading -->
                            <h3 class="fs-4 fw-bold mb-0">Account Settings</h3>
                            <!-- button -->
                            <button class="btn btn-outline-secondary btn-icon btn-sm ms-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#offcanvasAccount"
                                aria-controls="offcanvasAccount">
                                <i class="bi bi-list fs-3"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Sidebar -->
                    <div class="col-lg-3 col-md-4 col-12 border-end d-none d-md-block">
                        @include('frontend.layouts.includes.account-sidebar')
                    </div>

                    <!-- Notifications -->
                    <div class="col-lg-9 col-md-8 col-12">
                        <div class="py-6 px-md-6 px-lg-10">
                            <div class="mb-10">
                                <div class="border-bottom pb-3 mb-5">
                                    <h2 class="fw-bold">Notifications</h2>
                                </div>

                                @if ($notifications)
                                    @foreach ($notifications as $notification)
                                        <!-- Notification Card -->
                                        <div
                                            class="card mb-4 shadow-sm {{ is_null($notification->read_at) ? 'bg-white' : 'bg-light' }}">
                                            <div class="card-body d-flex justify-content-between align-items-center">
                                                <div>
                                                    <h6 class="mb-1 text-dark">
                                                        <i class="bi bi-box-seam me-2"></i>
                                                        Order #{{ $notification->data['order_id'] }}
                                                    </h6>
                                                    <p class="mb-0 text-muted small">
                                                        Placed on:
                                                        {{ \Carbon\Carbon::parse($notification->created_at)->format('M d, Y') }}
                                                    </p>
                                                </div>

                                                <div class="text-end">
                                                    <span
                                                        class="badge bg-success fs-6">৳{{ $notification->data['order_total'] }}</span>
                                                    <a href="{{ route('account.order.items', ['order' => $notification->data['order_id'] , 'notificationId' => $notification->id]) }}"
                                                        class="btn btn-sm btn-outline-primary ms-3">
                                                        View Order <i class="bi bi-arrow-right"></i>
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <div class="alert alert-info">
                                        No notifications available.
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
