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
                                <a href="#" class="btn btn-outline-primary" data-bs-toggle="modal"
                                    data-bs-target="#addAddressModal">Add a new address</a>
                            </div>
                            <div class="row">
                                @if ($addresses)
                                    @foreach ($addresses as $key=> $address)
                                        <div class="col-xl-5 col-lg-6 col-xxl-4 col-12 mb-4">
                                            <!-- form -->
                                            <div class="card">
                                                <div class="card-body p-6">
                                                    <div class="mb-6">
                                                        <b>{{ $address->mark }}</b>
                                                    </div>
                                                    <!-- address -->
                                                    <p class="mb-6">
                                                        {{ $address->name }}
                                                        <br />

                                                        {{ $address->address_line_1 }}
                                                        <br />

                                                        {{ $address->address_line_1 }}
                                                        <br />

                                                        {{ $address->zip_code }}
                                                    </p>
                                                    <!-- btn -->
                                                    @if ($address->is_default == 1)
                                                        <b style="color: green;">This is Default Address</b>
                                                    @else
                                                        <a href="{{route('address.default', $address->id)}}" class="btn btn-info btn-sm">Default address</a>
                                                    @endif
                                                    <div class="mt-4">
                                                        <a href="{{route('address.edit', $address)}}" class="text-inherit edit-address-btn">Edit</a>
                                                        <form action="{{ route('address.destroy', $address->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this address?');" style="display:inline;">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="text-danger btn btn-link p-0 ms-3">Delete</button>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal -->
    <div class="modal fade" id="addAddressModal" tabindex="-1" aria-labelledby="addAddressModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <!-- modal content -->
            <div class="modal-content">
                <!-- modal body -->
                <div class="modal-body p-6">
                    <div class="d-flex justify-content-between mb-5">
                        <div>
                            <!-- heading -->
                            <h5 class="mb-1" id="addAddressModalLabel">New Shipping Address</h5>
                            <p class="small mb-0">Add new shipping address for your order delivery.</p>
                        </div>
                        <div>
                            <!-- button -->
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                    </div>

                    <form action="{{ route('address.store') }}" method="POST">
                        @csrf
                        <div class="row g-3">
                            <!-- First Name -->
                            <div class="col-12">
                                <input type="text" class="form-control" name="name" placeholder="Name"
                                    aria-label="Name" required />
                            </div>

                            <!-- Marked Name -->
                            <div class="col-12">
                                <input type="text" class="form-control" name="mark" placeholder="Office or home"
                                    aria-label="Mark" required />
                            </div>

                            <!-- Address Line 1 -->
                            <div class="col-12">
                                <input type="text" class="form-control" name="address_line_1"
                                    placeholder="Address Line 1" required />
                            </div>

                            <!-- Address Line 2 -->
                            <div class="col-12">
                                <input type="text" class="form-control" name="address_line_2"
                                    placeholder="Address Line 2" />
                            </div>

                            <!-- City -->
                            <div class="col-12">
                                <input type="text" class="form-control" name="city" placeholder="City" required />
                            </div>

                            <!-- Country -->
                            <div class="col-12">
                                <select class="form-select" name="country" required>
                                    <option value="India" selected>India</option>
                                    <option value="UK">UK</option>
                                    <option value="USA">USA</option>
                                    <option value="UAE">UAE</option>
                                </select>
                            </div>

                            <!-- State -->
                            <div class="col-12">
                                <select class="form-select" name="state" required>
                                    <option value="Gujarat" selected>Gujarat</option>
                                    <option value="Northern Ireland">Northern Ireland</option>
                                    <option value="Alaska">Alaska</option>
                                    <option value="Abu Dhabi">Abu Dhabi</option>
                                </select>
                            </div>

                            <!-- Zip Code -->
                            <div class="col-12">
                                <input type="text" class="form-control" name="zip_code" placeholder="Zip Code"
                                    required />
                            </div>

                            <!-- Business Name -->
                            <div class="col-12">
                                <input type="text" class="form-control" name="business_name"
                                    placeholder="Business Name" />
                            </div>

                            <!-- Buttons -->
                            <div class="col-12 text-end">
                                <button type="button" class="btn btn-outline-primary"
                                    data-bs-dismiss="modal">Cancel</button>
                                <button class="btn btn-primary" type="submit">Save Address</button>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection