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
                                <li class="breadcrumb-item active"><a href="#!">&nbsp; Cart</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <section class="mb-lg-14 mb-8 mt-8">
            <div class="container">
                <!-- row -->
                <div class="row">
                    <div class="col-12">
                        <!-- card -->
                        <div class="card py-1 border-0 mb-8">
                            <div>
                                <h1 class="fw-bold">Shop Cart</h1>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- cart items -->
                @livewire('cart-item')
            </div>
        </section>
    </main>
@endsection
