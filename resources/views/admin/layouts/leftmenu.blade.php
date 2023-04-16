<div class="app-menu">
    <ul class="accordion-menu">
        <li class="sidebar-title">
            Welcome {{ Auth::user()->username }}
        </li>
        <li class="active-page">
            <a href="{{ route('adminDashboard') }}" class="active"><i class="material-icons-two-tone">dashboard</i>Dashboard</a>
        </li>
        <li>
            <a href="{{ route('manageUsers') }}"><i class="material-icons-two-tone">groups</i>Manage Users</a>
        </li>
        <li>
            <a href="{{ route('manageDeposits') }}"><i class="material-icons-two-tone">credit_card</i>Manage Deposits</a>
        </li>
        <li>
            <a href="{{ route('manageWithdrawals') }}"><i class="material-icons-two-tone">credit_card</i>Manage Withdrawals</a>
        </li>
        <li>
            <a href="{{ route('investment-plans.index') }}"><i class="material-icons-two-tone">payments</i>Investment Plans</a>
        </li>
        <li>
            <a href="{{ route('adminAddUserForm') }}"><i class="material-icons-two-tone">monetization_on</i>Add Users</a>
        </li>
        <li>
            <a href="{{ route('siteSettingsPage') }}"><i class="material-icons-two-tone">settings</i>Site Settings</a>
        </li>
        <li>
            <a href="{{ route('manageKyc') }}"><i class="material-icons-two-tone">settings</i>Manage KYC</a>
        </li>
        {{-- <li>
            <a href="{{ route('refer') }}"><i class="material-icons-two-tone">group_add</i>Refer Users<span class="badge rounded-pill badge-danger float-end">87</span></a>
        </li> --}}
        <li>
            <a href=""><i class="material-icons-two-tone">account_circle</i>Account<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
            <ul class="sub-menu">
                <li>
                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="">Log Out ({{ Auth::user()->username }})</a>
                    <form id="logout-form" action="{{ route('logAdminOut') }}" method="post" style="display: none">
                        @csrf
                    </form>
                </li>
                {{-- <li>
                    <a href="{{ route('acctinfo') }}">Withdrawal Info</a>
                </li> --}}
                <li>
                    <a href="{{ route('adminEditProfile') }}">Update Account</a>
                </li>
                <li>
                    <a href="#">Authentication<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ route('logUserInForm') }}">Sign In</a>
                        </li>
                        <li>
                            <a href="lock-screen.html">Lock Screen</a>
                        </li>
                    </ul>
                </li>

            </ul>
        </li>
    </ul>
</div>