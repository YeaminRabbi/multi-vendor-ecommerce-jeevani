@extends('frontend.layouts.master')

@section('content')
    <main>
        <!-- section -->

        <section class="my-lg-14 my-8">
            <!-- container -->
            <div class="container">
                <!-- row -->
                <div class="row justify-content-center align-items-center">
                    <div class="col-12 col-md-6 col-lg-4 order-lg-1 order-2">
                        <!-- img -->
                        <img src="{{ asset('frontend_asset/images/svg-graphics/signup-g.svg') }}" alt="img"
                            class="img-fluid" />
                    </div>
                    <!-- col -->
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1">
                        <div class="mb-lg-9 mb-5">
                            <h1 class="mb-1 h2 fw-bold">Get Start Shopping</h1>
                            <p>Welcome to {{config('app.name')}}! Enter your email to get started.</p>
                        </div>
                        <!-- form -->
                        @if ($errors->any())
                            <div id="ValidationCheck">
                                @foreach ($errors->all() as $error)
                                    <div class="alert alert-warning">
                                        <span style="color:black;">
                                        {{$error}}
                                        </span>
                                    </div>
                                @endforeach
                            </div>
                        @endif
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form class="needs-validation" method="POST" action="{{ route('auth.register') }}">
                            @csrf
                            <div class="row g-3">
                                <!-- col -->
                                <div class="col">
                                    <!-- input -->
                                    <label for="formSignupfname" class="form-label visually-hidden">Name</label>
                                    <input type="text" class="form-control" name="name" id="formSignupfname" placeholder="Name"
                                        required />
                                    <div class="invalid-feedback">Please enter name.</div>
                                </div>
                                <div class="col-12">
                                    <!-- input -->
                                    <label for="formSignupEmail" class="form-label visually-hidden">Email address</label>
                                    <input type="email" class="form-control" name="email" id="formSignupEmail" placeholder="Email"
                                        required />
                                    <div class="invalid-feedback">Please enter email.</div>
                                </div>
                                <div class="col-12">
                                    <div class="password-field position-relative">
                                        <label for="formSignupPassword" class="form-label visually-hidden">Password</label>
                                        <div class="password-field position-relative">
                                            <input type="password" class="form-control fakePassword" name="password" id="formSignupPassword"
                                                placeholder="*****" required />
                                            <span><i class="bi bi-eye-slash passwordToggler"></i></span>
                                            <div class="invalid-feedback">Please enter password.</div>
                                        </div>
                                    </div>
                                </div>
                                <!-- btn -->
                                <div class="col-12 d-grid">
                                    <button type="submit" class="btn btn-primary">Register</button>
                                </div>
                                <hr>
                                <div class="col-12 d-grid">
                                    <a href="{{url('/login')}}" class="btn btn-primary">Login</a>
                                </div>

                                <!-- text -->   
                                <p>
                                    <small>
                                        By continuing, you agree to our
                                        <a href="#!">Terms of Service</a>
                                        &
                                        <a href="#!">Privacy Policy</a>
                                    </small>
                                </p>
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