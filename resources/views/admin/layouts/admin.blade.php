{{-- resources/views/admin/layouts/admin.blade.php --}}
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Admin Panel</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    {{-- <script defer src="{{ asset('js/popup.js') }}"></script> --}}
    @stack('styles')
</head>

<body>
    <div class="sidebar">
        <h2>Trade-Swap</h2>
        <ul class="nav-links">
            <li class="{{ request()->is('admin/dashboard') ? 'active' : '' }}">
                <a href="{{ route('admin.dashboard') }}"><i class="fas fa-tachometer-alt"></i>Dashboard</a>
            </li>
            <li class="{{ request()->is('admin/users*') ? 'active' : '' }}">
                <a href="{{ route('admin.users.index') }}"><i class="fas fa-user"></i>Users</a>
            </li>

            <li class="{{ request()->is('admin/product*') ? 'active' : '' }}">
                <a href="{{ route('admin.product.index') }}"><i class="fas fa-box-open"></i> Products</a>
            </li>

            <li class="{{ request()->is('admin/subscription*') ? 'active' : '' }}">
                <a href="{{ route('admin.subscription.index') }}"><i class="fas fa-user-check"></i>Subscriptions</a>
            </li>
            <li class="{{ request()->is('admin/withdraw_request*') ? 'active' : '' }}">
                <a href="{{ route('admin.withdraw_request.index') }}"><i class="fas fa-user-check"></i>Withdraw Request</a>
            </li>

            <li class="{{ request()->is('admin/coupons*') ? 'active' : '' }}">
                <a href="{{ route('admin.coupons.index') }}">
                    <i class="fas fa-tags"></i> Coupons
                </a>
            </li>

            <li class="{{ request()->is('admin/orders*') ? 'active' : '' }}">
                <a href="{{ route('admin.orders.index') }}"><i class="fas fa-file-invoice-dollar"></i> Orders</a>
            </li>
            <li class="{{ request()->is('admin/payments*') ? 'active' : '' }}">
                <a href="{{ route('admin.payments.index') }}">
                    <i class="fas fa-credit-card"></i> Payments
                </a>
            </li>


            <li class="{{ request()->is('admin/bill-cashback*') ? 'active' : '' }}">
                <a href="{{ route('admin.bill_cashback.index') }}">
                    <i class="fas fa-file-invoice-dollar"></i> Bill Details-Cashback
                </a>
            </li>

            <li class="{{ request()->is('admin/bill-reward*') ? 'active' : '' }}">
                <a href="{{ route('admin.bill_reward.index') }}">
                    <i class="fas fa-file-invoice-dollar"></i> Bill Details-Reward
                </a>
            </li>


            <li class="{{ request()->is('admin/wallet*') ? 'active' : '' }}">
                <a href="{{ route('admin.wallet.index') }}"><i class="fas fa-wallet"></i> Wallet</a>
            </li>

              <li class="{{ request()->is('admin/support*') ? 'active' : '' }}">
                <a href="{{ route('admin.supports.index') }}"><i class="fas fa-headset"></i> Support</a>
            </li>

            <li class="{{ request()->is('admin/reports*') ? 'active' : '' }}">
                <a href="{{ route('admin.reports.index') }}"><i class="fas fa-chart-line"></i> Reports</a>
            </li>
          

        </ul>

        <div class="dropdown">
            <div class="dropdown-toggle">
                <span><i class="fas fa-cogs"></i> Manage App</span>
                <i class="fas fa-chevron-down"></i>
            </div>
            <ul class="dropdown-menu">
                <li class="{{ request()->is('admin/manage_app*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage_app.sliders') }}"><i class="fas fa-images"></i> Slider</a></a>
                </li>
                <li class="{{ request()->is('admin/manage_app*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage_app.pages') }}"><i class="fas fa-file-alt"></i> Pages</a></a></a>
                </li>
                {{-- <li class="{{ request()->is('admin/manage_app*') ? 'active' : '' }}">
                    <a href="{{ route('admin.manage_app.popup') }}"><i class="fas fa-bell"></i> Popup</a></a></a>
                </li> --}}
            </ul>
        </div>
    </div>


    <div class="navbar">
        <div class="profile-menu" id="profileMenu">
            <div class="profile-icon">
                <i class="fas fa-user-circle"></i> {{ Auth::guard('admin')->user()->name ?? 'Admin' }} <i
                    class="fas fa-chevron-down"></i>
            </div>
            <div class="profile-dropdown">
                <!--<a href="{{ route('admin.profile.edit') }}" class="dropdown-item">-->
                <!--    <i class="fas fa-user-edit"></i>-->
                <!--    <span>Edit Profile</span>-->
                <!--</a>-->

                <form method="POST" action="{{ route('admin.logout') }}" class="dropdown-item logout-form">
                    @csrf
                    <button type="submit">
                        <i class="fas fa-sign-out-alt"></i>
                        <span>Logout</span>
                    </button>
                </form>
            </div>

        </div>
    </div>

    <div class="main-content">
        @include('admin.include.alert')
        @yield('content')
    </div>

    <script>
        const dropdown = document.querySelector('.dropdown');
        const toggle = dropdown.querySelector('.dropdown-toggle');
        toggle.addEventListener('click', () => {
            dropdown.classList.toggle('open');
        });

        const profileMenu = document.getElementById('profileMenu');
        profileMenu.addEventListener('click', (e) => {
            e.stopPropagation();
            profileMenu.classList.toggle('open');
        });

        document.addEventListener('click', (e) => {
            if (!profileMenu.contains(e.target)) {
                profileMenu.classList.remove('open');
            }
        });
    </script>
    @stack('scripts')
</body>

</html>
