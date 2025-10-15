<header class="py-lg-2 py-4 border-bottom border-bottom-lg-0">
    <div class="container">

        @php
            $widgetGroup = \App\Helpers\Frontend::getWidgetByGroupName('header');
        @endphp

        <div class="row w-100 align-items-center gx-3">
            {{-- Desktop --}}
            <div class="col-xl-3 col-lg-4">
                <?php /*
                <div class="d-flex align-items-center">
                    @if ($widgetGroup)
                        <div class="list-inline xms-auto d-lg-block d-none">
                            @if ($component = $widgetGroup->widgets->firstWhere('meta_name', 'top_navbar'))
                                @if ($component->is_active == 1)
                                    @foreach ($component->settings as $name => $url)
                                        <div class="list-inline-item me-3">
                                            <a href="{{ $url }}" class="text-reset">{{ $name }}</a>
                                        </div>
                                    @endforeach
                                @endif
                            @endif
                        </div>
                    @endif
                </div>
                */ ?>
                <a class="navbar-brand d-none d-lg-block text-left" href="{{ url('/') }}">
                                            <img src="{{\App\Helpers\Frontend::filePath(setting("site_logo"))}}" alt="" />
{{--                    <h2 class="mb-0">{{ config('app.name') }}</h2>--}}
                </a>
            </div>


            {{-- Desktop --}}
            <div class="col-xl-7 col-lg-4">
                <form action="{{ route('products.search') }}" method="GET">
                    <div class="input-group">
                        <input name="query" class="form-control rounded" type="search"
                               placeholder="Search for products" value="{{ old('query', $query ?? '') }}" />
                        <span class="input-group-append">
                                      <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end"
                                              type="submit">
                                          <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                               viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                               stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                                               class="feather feather-search">
                                              <circle cx="11" cy="11" r="8"></circle>
                                              <line x1="21" y1="21" x2="16.65" y2="16.65">
                                              </line>
                                          </svg>
                                      </button>
                                  </span>
                    </div>
                </form>
            </div>

            {{-- Desktop --}}
            <div class="col-xl-2 col-lg-4 d-flex align-items-center">
                <div class="list-inline ms-auto d-lg-block d-none">

                    <div class="list-inline-item  me-3">
                        <a type="button" class="text-muted" data-bs-toggle="modal" data-bs-target="#SearchModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </a>
                    </div>
                    <div class="list-inline-item me-3">
                        <a href="{{ Auth::check() ? route('account.order') : url('/login') }}" class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </a>
                    </div>
                    <div class="list-inline-item me-3">
                        <a class="text-muted position-relative" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" href="#offcanvasExample" role="button"
                            aria-controls="offcanvasRight">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-shopping-bag">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>

                            @php
                                $cartItemCount = \App\Helpers\Frontend::countCartItems();
                            @endphp

                            @if ($cartItemCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                    {{ $cartItemCount }}
                                    <span class="visually-hidden">cart-items</span>
                                </span>
                            @endif
                        </a>
                    </div>

                </div>
            </div>
        </div>


        {{--        Mobile --}}
        <div class="d-flex justify-content-between align-items-center w-100 d-lg-none">
            <a class="navbar-brand mb-0" href="{{ url('/') }}">
                {{--                <img src="../assets/images/logo/freshcart-logo.svg" alt="eCommerce HTML Template" /> --}}
                <h2 class="mb-0">{{ config('app.name') }}</h2>
            </a>

            <div class="d-flex align-items-center lh-1">
                <div class="list-inline me-0">
                    <div class="list-inline-item me-3">
                        <a type="button" class="text-muted" data-bs-toggle="modal" data-bs-target="#SearchModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="feather feather-search">
                                <circle cx="11" cy="11" r="8"></circle>
                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                            </svg>
                        </a>
                    </div>
                    <div class="list-inline-item me-3">
                        <a href="{{ Auth::check() ? route('account.order') : url('/login') }}" class="text-muted">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-user">
                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                <circle cx="12" cy="7" r="4"></circle>
                            </svg>
                        </a>
                    </div>
                    <div class="list-inline-item me-3">
                        <a class="text-muted position-relative" data-bs-toggle="offcanvas"
                            data-bs-target="#offcanvasRight" href="#offcanvasExample" role="button"
                            aria-controls="offcanvasRight">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20"
                                viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                stroke-linecap="round" stroke-linejoin="round" class="feather feather-shopping-bag">
                                <path d="M6 2L3 6v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V6l-3-4z"></path>
                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                <path d="M16 10a4 4 0 0 1-8 0"></path>
                            </svg>

                            @php
                                $cartItemCount = \App\Helpers\Frontend::countCartItems();
                            @endphp

                            @if ($cartItemCount > 0)
                                <span
                                    class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
                                    {{ $cartItemCount }}
                                    <span class="visually-hidden">cart-items</span>
                                </span>
                            @endif
                        </a>
                    </div>
                </div>
                <!-- Button -->
                <button class="navbar-toggler collapsed" type="button" data-bs-toggle="offcanvas"
                    data-bs-target="#navbar-default" aria-controls="navbar-default" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <svg xmlns="http://www.w3.org/2000/svg" width="32" height="32" fill="currentColor"
                        class="bi bi-text-indent-left text-primary" viewBox="0 0 16 16">
                        <path
                            d="M2 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5zm.646 2.146a.5.5 0 0 1 .708 0l2 2a.5.5 0 0 1 0 .708l-2 2a.5.5 0 0 1-.708-.708L4.293 8 2.646 6.354a.5.5 0 0 1 0-.708zM7 6.5a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm0 3a.5.5 0 0 1 .5-.5h6a.5.5 0 0 1 0 1h-6a.5.5 0 0 1-.5-.5zm-5 3a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 0 1h-11a.5.5 0 0 1-.5-.5z" />
                    </svg>
                </button>
            </div>
        </div>
    </div>
</header>




<nav class="navbar navbar-expand-lg navbar-light navbar-default py-0 py-lg-2 border-top navbar-offcanvas-color border-bottom-lg"
    aria-label="Offcanvas navbar large">
    <div class="container">
        <div class="offcanvas offcanvas-start" tabindex="-1" id="navbar-default"
            aria-labelledby="navbar-defaultLabel">
            <div class="offcanvas-header pb-1">
                <a href="{{ url('/') }}">
                    {{--                    <img src="../assets/images/logo/freshcart-logo.svg" alt="eCommerce HTML Template" /> --}}
                    <h2 class="mb-0">{{ config('app.name') }}</h2>
                </a>
                <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
            </div>
            <div class="offcanvas-body mx-lg-auto">
                <div>
                    <ul class="navbar-nav align-items-center">
                        @if ($widgetGroup)
                            @php $component = $widgetGroup->widgets->firstWhere('meta_name', 'second_navbar'); @endphp
                            <div class="list-inline xms-auto d-lg-block d-none">
                                @if ($component)
                                    @if ($component->is_active == 1)
                                        @foreach ($component->settings as $name => $url)
                                            <div class="list-inline-item me-3">
                                                <a href="{{ $url }}"
                                                    class="text-reset">{{ $name }}</a>
                                            </div>
                                        @endforeach
                                    @endif
                                @endif
                            </div>
                            <div class="d-block d-lg-none mb-4 w-100">
                                <form action="{{ route('products.search') }}" method="GET">
                                    <div class="input-group">
                                        <input name="query" value="{{ old('query', $query ?? '') }}" class="form-control rounded" type="search" placeholder="Search for products">
                                        <span class="input-group-append">
                                          <button class="btn bg-white border border-start-0 ms-n10 rounded-0 rounded-end" type="button">
                                             <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-search">
                                                <circle cx="11" cy="11" r="8"></circle>
                                                <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                             </svg>
                                          </button>
                                       </span>
                                    </div>
                                </form>

                                @if($component && $component->is_active == 1)
                                    @foreach($component->settings as $name => $url)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{ $url }}">{{ $name }}</a>
                                        </li>
                                    @endforeach
                                @endif
                            </div>
                        @endif

                        <?php /*
                        <li class="nav-item w-100 w-lg-auto">
                            @if (Auth::check())
                                <a class="nav-link" href="{{ route('account.order') }}">Dashboard</a>
                            @else
                                <a class="nav-link" href="{{ url('/login') }}">Login</a>
                            @endif
                        </li>
                        */ ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</nav>


{{-- @include('frontend.layouts.includes.xnavbar') --}}
