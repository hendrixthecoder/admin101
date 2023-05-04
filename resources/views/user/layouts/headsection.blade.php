<div class="app align-content-stretch d-flex flex-wrap">
    <div class="app-sidebar">
        <div class="logo" style="">

                <img src="{{ env('APP_URL') }}cloud/uploads/pfp/empty.png" alt="" style="width:80px; border-radius:80px; height:80px;" >


            {{-- <a href="{{ route('home') }}" class="logo-icon"><span class="logo-text">Admin101</span></a> --}}
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