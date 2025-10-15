@extends('frontend.layouts.master')

@section('content')
    <main>
        <!-- section -->
        <section>
            <!-- container -->
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
                            <div class="mb-6">
                                <!-- heading -->
                                <h2 class="mb-0">Account Setting</h2>
                                @if (session('status'))
                                    <div class="alert alert-success ValidationCheck">
                                        {{ session('status') }}
                                    </div>
                                @endif
                                @if ($errors->any())
                                    <div class="ValidationCheck">
                                        @foreach ($errors->all() as $error)
                                            <div class="alert alert-warning">
                                                <span style="color:black;">
                                                    {{ $error }}
                                                </span>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div>
                                <!-- heading -->
                                <h5 class="mb-4">Account details</h5>
                                <div class="row">
                                    <div class="col-lg-5">
                                        <!-- form -->
                                        <form action="{{ route('update.user.info') }}" method="POST">
                                            @csrf
                                            <!-- input -->
                                            <div class="mb-3">
                                                <label class="form-label">Name</label>
                                                <input type="text" class="form-control" placeholder="jitu chauhan"
                                                    name="name" value="{{ $user->name }}" required />
                                            </div>
                                            <!-- input -->
                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email" class="form-control" placeholder="example@gmail.com"
                                                    name="email" value="{{ $user->email }}" required />
                                            </div>
                                            <!-- input -->
                                            <div class="mb-5">
                                                <label class="form-label">Phone</label>
                                                <input type="text" class="form-control" placeholder="Phone number"
                                                    name="phone" value="{{ $user->phone }}" />
                                            </div>
                                            <!-- button -->
                                            <div class="mb-3">
                                                <button class="btn btn-primary">Save Details</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <hr class="my-10" />
                            <div class="pe-lg-14">
                                <!-- heading -->
                                <h5 class="mb-4">Password</h5>
                                <form class="row row-cols-1 row-cols-lg-2" action="{{ route('update.user.password') }}"
                                    method="POST">
                                    @csrf
                                    <!-- Current Password -->
                                    <div class="mb-3 col">
                                        <label class="form-label">Current Password</label>
                                        <input type="password" class="form-control" name="current_password"
                                            placeholder="**********" required />
                                        @error('current_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- New Password -->
                                    <div class="mb-3 col">
                                        <label class="form-label">New Password</label>
                                        <input type="password" class="form-control" name="new_password"
                                            placeholder="**********" required />
                                        @error('new_password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <!-- Submit Button -->
                                    <div class="col-12">
                                        <button type="submit" class="btn btn-primary">Save Password</button>
                                    </div>
                                </form>

                            </div>
                            <hr class="my-10" />
                            <div>
                                <!-- heading -->
                                <h5 class="mb-4">Delete Account</h5>
                                <p class="mb-2">Would you like to delete your account?</p>
                                <p class="mb-5">Deleting your account will remove all the records associated with it.</p>
                               
                                <!-- form with POST method -->
                                <form method="POST" action="{{ route('delete.user.account') }}" onsubmit="return confirm('Are you sure you want to delete your account? This action cannot be undone.');">
                                    @csrf 
                                    <button type="submit" class="btn btn-outline-danger">I want to delete my account</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection

@section('js')
    <script>
        $('.ValidationCheck').delay(5000).fadeOut('slow');
    </script>
@endsection
