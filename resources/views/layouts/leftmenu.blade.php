<div class="app-menu">
    <ul class="accordion-menu">
        <li class="sidebar-title">
            @lang('messages.welcome') {{ Auth::user()->username }}
        </li>
        <li class="active-page">
            <a href="{{ route('home') }}" class="active"><i class="material-icons-two-tone">dashboard</i>@lang('messages.dashboard')</a>
        </li>
        <li>
            <a href="{{ route('support') }}"><i class="material-icons-two-tone">contact_support</i>@lang('messages.support')</a>
        </li>
        <li>
            <a href="{{ route('deposits') }}"><i class="material-icons-two-tone">credit_card</i>@lang('messages.deposits')</a>
        </li>
        <li>
            <a href="{{ route('mywithdrawals') }}"><i class="material-icons-two-tone">credit_card</i>@lang('messages.withdrawals')</a>
        </li>
        <li>
            <a href="{{ route('investplans') }}"><i class="material-icons-two-tone">payments</i>@lang('messages.investmentPlans')</a>
        </li>
        <li>
            <a href="{{ route('myplans') }}"><i class="material-icons-two-tone">monetization_on</i>@lang('messages.myInvestmentPlans')</a>
        </li>
        <li>
            <a href="{{ route('accthist') }}"><i class="material-icons-two-tone">history_toggle_off</i>@lang('messages.transactionHistory')</a>
        </li>
        <li>
            <a href="{{ route('refer') }}"><i class="material-icons-two-tone">group_add</i>@lang('messages.referUsers')<span class="badge rounded-pill badge-danger float-end">87</span></a>
        </li>
        <li>
            <a href="#"><i class="material-icons-two-tone">translate</i>{{ Config::get('languages')[App::getLocale()] }}<span class="badge rounded-pill badge-danger float-end">8</span></a>
            <ul class="sub-menu">
                @foreach (Config::get('languages') as $lang => $language)
                    @if ($lang != App::getLocale())
                        <li>
                            <a href="{{ route('setLocale', $lang) }}">{{ $language }}</a>
                        </li>
                    @endif
                @endforeach
            </ul>
        </li>
        <li>
            <a href=""><i class="material-icons-two-tone">account_circle</i>@lang('messages.account')<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
            <ul class="sub-menu">
                <li>
                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" href="{{ route('logUserInForm') }}">@lang('messages.logOut') ({{ Auth::user()->username }})</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="post" style="display: none">
                        @csrf

                    </form>
                </li>
                <li>
                    <a href="{{ route('acctinfo') }}">@lang('messages.withdrawalInfo')</a>
                </li>
                <li>
                    <a href="{{ route('user.edit', ['user' => Auth::user()]) }}">@lang('messages.updateAcct')</a>
                </li>
                {{-- <li>
                    <a href="#">Authentication<i class="material-icons has-sub-menu">keyboard_arrow_right</i></a>
                    <ul class="sub-menu">
                        <li>
                            <a href="{{ route('logUserInForm') }}">Sign In</a>
                        </li>
                        <li>
                            <a href="lock-screen.html">Lock Screen</a>
                        </li>
                    </ul>
                </li> --}}

            </ul>
        </li>
    </ul>
</div>