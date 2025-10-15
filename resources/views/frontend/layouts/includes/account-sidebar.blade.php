<div class="pt-10 pe-lg-10">
    <!-- nav -->
    <ul class="nav flex-column nav-pills nav-pills-dark">
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link {{(Route::currentRouteName() === 'account.order' || Route::currentRouteName() === 'account.order.items') ? 'active' : ''}}" aria-current="page" href="{{route('account.order')}}">
                <i class="feather-icon icon-shopping-bag me-2"></i>
                Your Orders
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() === 'account.settings' ? 'active' : ''}}" href="{{route('account.settings')}}">
                <i class="feather-icon icon-settings me-2"></i>
                Settings
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() === 'address.index' || Route::currentRouteName() === 'address.edit' ? 'active' : ''}}" href="{{route('address.index')}}">
                <i class="feather-icon icon-map-pin me-2"></i>
                Address
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() === 'account.payment.method' ? 'active' : ''}}" href="{{route('account.payment.method')}}">
                <i class="feather-icon icon-credit-card me-2"></i>
                Payment Method
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link {{Route::currentRouteName() === 'account.notification' ? 'active' : ''}}" href="{{route('account.notification')}}">
                <i class="feather-icon icon-bell me-2"></i>
                Notification
            </a>
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <hr />
        </li>
        <!-- nav item -->
        <li class="nav-item">
            <a class="nav-link" href="{{route('logout')}}">
                <i class="feather-icon icon-log-out me-2"></i>
                Log out
            </a>
        </li>
    </ul>
</div>