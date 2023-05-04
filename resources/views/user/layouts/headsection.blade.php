<div class="app align-content-stretch d-flex flex-wrap">
    <div class="app-sidebar">
        <div class="logo" style="">
            @if (Auth::user()->pfp_path == 'empty')
                <img src="{{ env('APP_URL') }}cloud/uploads/pfp/emptyy.jpg" alt="" style="width:50px; border-radius:100%; height:50px; margin-top:-4px">
            @else
                <img src="{{ env('APP_URL') }}cloud/uploads/pfp/{{ Auth::user()->pfp_path }}" alt="">
            @endif
            <div class="sidebar-user-switcher user-activity-online">
                <a href="#">
                </a>
            </div>
        </div>
        @include('layouts.leftmenu')
    </div>
    <div class="app-container">
        <div class="search">
            <form>
                <input class="form-control" type="text" placeholder="Type here..." aria-label="Search">
            </form>
            <a href="#" class="toggle-search"><i class="material-icons">close</i></a>
        </div>
        <div class="app-header">
            <nav class="navbar navbar-light navbar-expand-lg">
                <div class="container-fluid">
                    <div class="navbar-nav" id="navbarNav">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a class="nav-link hide-sidebar-toggle-button" href="#"><i class="material-icons">first_page</i></a>
                            </li>
                        </ul>
        
                    </div>
                </div>
            </nav>
        </div>
        @yield('content')
    </div>
</div>