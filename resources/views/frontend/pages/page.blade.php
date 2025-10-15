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
                                <li class="breadcrumb-item-product"><a href="#!">&nbsp;Page /</a></li>
                                <li class="breadcrumb-item-product"><a href="#!">&nbsp;{{ $pageContent->title }}</a>
                                </li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <!-- section -->
        <div class="mb-lg-14 mb-8">
            <!-- container -->
            <div class="container">
                <div class="row gx-10">
                    <section class="my-lg-3 my-3">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <!-- text -->
                                    <div class="mb-3">
{{--                                        <h1 class="fw-bold text-center">{{ $pageContent->title }}</h1>--}}
{{--                                        <div class="d-flex justify-content-center text-muted mt-4">--}}
{{--                                            <span--}}
{{--                                                class="me-2"><small>{{ $pageContent->published_at->format('d F Y') }}</small></span>--}}
{{--                                        </div>--}}
                                    </div>

                                    @if ($pageContent->featuredImage)
                                        <!-- img -->
                                        <div class="mb-3">
                                            <img src="{{$Media($pageContent->featuredImage->id.'/'. $pageContent->featuredImage->file_name)}}" alt="Image"
                                                class="img-fluid rounded" />
                                        </div>
                                    @endif

                                    <div style="text-align: justify;">
                                        {!! \App\Helpers\Frontend::convertMarkdownToHtml($pageContent->body )  !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </main>
@endsection
