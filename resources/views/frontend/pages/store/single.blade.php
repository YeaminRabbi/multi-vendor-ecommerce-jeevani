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
                                <li class="breadcrumb-item-home"><a href="{{route('home')}}">Home /</a></li>
                                <li class="breadcrumb-item-store"><a href="#!">&nbsp; Stores /</a></li>
                                <li class="breadcrumb-item" >&nbsp; {{$store->name}}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <section class="mb-lg-14 mb-8 mt-8">
            <div class="container">
                @livewire('store-product-list', ['shop' => $store])
            </div>
        </section>
    </main>
@endsection
