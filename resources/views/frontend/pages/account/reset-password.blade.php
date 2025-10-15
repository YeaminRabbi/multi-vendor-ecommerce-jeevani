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
                        <img src="{{asset('frontend_assetv/images/svg-graphics/fp-g.svg')}}" alt="Img" class="img-fluid" />
                    </div>
                    <div class="col-12 col-md-6 offset-lg-1 col-lg-4 order-lg-2 order-1 d-flex align-items-center">
                        <div>
                            <div class="mb-lg-9 mb-5">
                                <!-- heading -->
                                <h1 class="mb-2 h2 fw-bold">Reset your password</h1>
                                <p>Please enter your new password below to reset your account password.</p>
                            </div>
                            <!-- form -->
                            @if (session('status'))
                                <div class="alert alert-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                            <form class="needs-validation" novalidate method="POST" action="{{ route('password.update') }}">
                                @csrf
                                <input type="hidden" name="token" value="{{ $token }}">

                                <!-- row -->
                                <div class="row g-3">
                                    <!-- col -->
                                    <div class="col-12">
                                        <!-- input for email -->
                                        <label for="formResetEmail" class="form-label visually-hidden">Email
                                            address</label>
                                        <input type="email" class="form-control" id="formResetEmail" name="email" value="{{ old('email') }}" placeholder="Email" required />
                                        <div class="invalid-feedback">Please enter a valid email address.</div>
                                    </div>

                                    <!-- col for new password -->
                                    <div class="col-12">
                                        <label for="newPassword" class="form-label visually-hidden">New Password</label>
                                        <input type="password" class="form-control" id="newPassword" name="password" placeholder="New Password" required />
                                        <div class="invalid-feedback">Please enter a new password.</div>
                                    </div>

                                    <!-- col for confirm password -->
                                    <div class="col-12">
                                        <label for="confirmPassword" class="form-label visually-hidden">Confirm Password</label>
                                        <input type="password" class="form-control" id="confirmPassword" name="password_confirmation" placeholder="Confirm Password" required />
                                        <div class="invalid-feedback">Please confirm your new password.</div>
                                    </div>

                                    <!-- btn -->
                                    <div class="col-12 d-grid gap-2">
                                        <button type="submit" class="btn btn-primary">Reset Password</button>
                                        <a href="{{ route('account.signin') }}" class="btn btn-light">Back</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection