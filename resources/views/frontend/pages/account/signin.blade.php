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
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Sign in</h1>
                        </div>

                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        @if (\Session::has('error'))
                            <div id="ValidationCheck">
                                <div class="alert alert-warning">
                                    <span style="color:black;">
                                        {!! \Session::get('error') !!}
                                    </span>
                                </div>
                            </div>
                        @endif
                        <form class="needs-validation" method="POST" action="{{ route('auth.login') }}">
                            @csrf
                            <div class="row g-3">
                                <!-- row -->

                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formSigninEmail" class="form-label visually-hidden">Email address</label>
                                    <input type="email" class="form-control" name="email" id="formSigninEmail"
                                        placeholder="Email" required />
                                    <div class="invalid-feedback">Please enter name.</div>
                                </div>
                                <div class="col-12">
                                    <!-- input -->
                                    <div class="password-field position-relative">
                                        <label for="formSigninPassword" class="form-label visually-hidden">Password</label>
                                        <div class="password-field position-relative">
                                            <input type="password" class="form-control fakePassword" name="password"
                                                id="formSigninPassword" placeholder="*****" required />
                                            <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                            <div class="invalid-feedback">Please enter password.</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-between">
                                    <!-- form check -->
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="" name="remember_me"
                                            id="flexCheckDefault" />
                                        <!-- label -->
                                        <label class="form-check-label" for="flexCheckDefault">Remember me</label>
                                    </div>
                                    <div>
                                        Forgot password?
                                        <a href="{{route('account.forgot.password')}}">Reset It</a>
                                    </div>
                                </div>
                                <!-- btn -->
                                <div class="col-12 d-grid"><button type="submit" class="btn btn-primary">Sign In</button>
                                </div>
                                <!-- link -->
                                <div>
                                    Don’t have an account?
                                    <a href="{{ route('account.signup') }}">Sign Up</a>
                                </div>
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
    $('#ValidationCheck').delay(5000).fadeOut('slow');
</script>
@endsection
