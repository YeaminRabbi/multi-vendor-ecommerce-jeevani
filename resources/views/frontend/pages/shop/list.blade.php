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
                                <li class="breadcrumb-item-home"><a href="{{route('home')}}">Home /</a></li>
                                <li class="breadcrumb-item-shop"><a href="#!">&nbsp;Shop</a></li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <div class="mt-8 mb-lg-14 mb-8">
            <!-- container -->
            <div class="container">
                @livewire('shop-product-list')
            </div>
        </div>
    </main>
@endsection