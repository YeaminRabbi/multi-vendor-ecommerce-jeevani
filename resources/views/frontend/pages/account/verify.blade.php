@extends('frontend.layouts.master')

@section('content')
    <main>
        <!-- section -->
        <section class="my-lg-14 my-8">
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <!-- img -->
                        <img src="{{ asset('frontend_asset/images/svg-graphics/signin-g.svg') }}" alt="img"
                            class="img-fluid" />
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div id="notification">
                            @if (session('resent'))
                                <div class="alert alert-success" role="alert">
                                    {{ __('A fresh verification link has been sent to your email address.') }}
                                </div>
                            @endif
                            @if (session('verify'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('verify') }}
                                </div>
                            @endif
                        </div>
                        {{ __('Before proceeding, please check your email for a verification link.') }}
                        {{ __('If you did not receive the email') }},
                        <form class="d-inline" method="POST" action="{{route('account.verify.email', ['resent' => true])}}">
                            @csrf
                             <!-- btn -->
                             <div class="col-12 d-grid">
                                <button type="submit" class="btn btn-primary">{{ __('Click here to request another') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
<script>
    $('#notification').delay(5000).fadeOut('slow');     
</script>
@endsection