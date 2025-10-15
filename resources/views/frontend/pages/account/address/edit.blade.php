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
                            <div class="d-flex justify-content-between mb-6">
                                <!-- heading -->
                                <h2 class="mb-0">Address</h2>
                                <!-- button -->
                                <a href="{{route('address.index', $address)}}" class="btn btn-primary">Back</a>
                            </div>
                            <form action="{{ route('address.update', $address->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="row g-3">
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="name" value="{{ old('name', $address->name) }}" placeholder="Name" aria-label="Name" required />
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="mark" value="{{ old('mark', $address->mark) }}" placeholder="Office or home" aria-label="Mark" required />
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="address_line_1" value="{{ old('address_line_1', $address->address_line_1) }}" placeholder="Address Line 1" required />
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="address_line_2" value="{{ old('address_line_2', $address->address_line_2) }}" placeholder="Address Line 2" />
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="city" value="{{ old('city', $address->city) }}" placeholder="City" required />
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" name="country" required>
                                            <option value="India" {{ old('country', $address->country) == 'India' ? 'selected' : '' }}>India</option>
                                            <option value="UK" {{ old('country', $address->country) == 'UK' ? 'selected' : '' }}>UK</option>
                                            <option value="USA" {{ old('country', $address->country) == 'USA' ? 'selected' : '' }}>USA</option>
                                            <option value="UAE" {{ old('country', $address->country) == 'UAE' ? 'selected' : '' }}>UAE</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <select class="form-select" name="state" required>
                                            <option value="Gujarat" {{ old('state', $address->state) == 'Gujarat' ? 'selected' : '' }}>Gujarat</option>
                                            <option value="Northern Ireland" {{ old('state', $address->state) == 'Northern Ireland' ? 'selected' : '' }}>Northern Ireland</option>
                                            <option value="Alaska" {{ old('state', $address->state) == 'Alaska' ? 'selected' : '' }}>Alaska</option>
                                            <option value="Abu Dhabi" {{ old('state', $address->state) == 'Abu Dhabi' ? 'selected' : '' }}>Abu Dhabi</option>
                                        </select>
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="zip_code" value="{{ old('zip_code', $address->zip_code) }}" placeholder="Zip Code" required />
                                    </div>
                                    <div class="col-12">
                                        <input type="text" class="form-control" name="business_name" value="{{ old('business_name', $address->business_name) }}" placeholder="Business Name" />
                                    </div>
                                    <div class="col-12 text-end">
                                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                        <button class="btn btn-primary" type="submit">Update Address</button>
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