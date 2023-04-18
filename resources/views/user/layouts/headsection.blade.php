<div class="app align-content-stretch d-flex flex-wrap">
    <div class="app-sidebar">
        <div class="logo">
            <a href="{{ route('home') }}" class="logo-icon"><span class="logo-text">Admin101</span></a>
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
                    {{-- <div class="d-flex">
                        <ul class="navbar-nav">
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link active" href="#">Applications</a>
                            </li>
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link" href="#">Reports</a>
                            </li>
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link" href="#">Projects</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link toggle-search" href="#"><i class="material-icons">search</i></a>
                            </li>
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link language-dropdown-toggle" href="#" id="languageDropDown" data-bs-toggle="dropdown"><img src="{{ asset('images/flags/us.png') }}" alt=""></a>
                                    <ul class="dropdown-menu dropdown-menu-end language-dropdown" aria-labelledby="languageDropDown">
                                        <li><a class="dropdown-item" href="#"><img src="{{ asset('images/flags/germany.png') }}" alt="">German</a></li>
                                        <li><a class="dropdown-item" href="#"><img src="{{ asset('images/flags/italy.png') }}" alt="">Italian</a></li>
                                        <li><a class="dropdown-item" href="#"><img src="{{ asset('images/flags/china.png') }}" alt="">Chinese</a></li>
                                    </ul>
                            </li>
                            <li class="nav-item hidden-on-mobile">
                                <a class="nav-link nav-notifications-toggle" id="notificationsDropDown" href="#" data-bs-toggle="dropdown">4</a>
                                <div class="dropdown-menu dropdown-menu-end notifications-dropdown" aria-labelledby="notificationsDropDown">
                                    <h6 class="dropdown-header">Notifications</h6>
                                    <div class="notifications-dropdown-list">
                                        <a href="#">
                                            <div class="notifications-dropdown-item">
                                                <div class="notifications-dropdown-item-image">
                                                    <span class="notifications-badge bg-info text-white">
                                                        <i class="material-icons-outlined">campaign</i>
                                                    </span>
                                                </div>
                                                <div class="notifications-dropdown-item-text">
                                                    <p class="bold-notifications-text">Donec tempus nisi sed erat vestibulum, eu suscipit ex laoreet</p>
                                                    <small>19:00</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notifications-dropdown-item">
                                                <div class="notifications-dropdown-item-image">
                                                    <span class="notifications-badge bg-danger text-white">
                                                        <i class="material-icons-outlined">bolt</i>
                                                    </span>
                                                </div>
                                                <div class="notifications-dropdown-item-text">
                                                    <p class="bold-notifications-text">Quisque ligula dui, tincidunt nec pharetra eu, fringilla quis mauris</p>
                                                    <small>18:00</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notifications-dropdown-item">
                                                <div class="notifications-dropdown-item-image">
                                                    <span class="notifications-badge bg-success text-white">
                                                        <i class="material-icons-outlined">alternate_email</i>
                                                    </span>
                                                </div>
                                                <div class="notifications-dropdown-item-text">
                                                    <p>Nulla id libero mattis justo euismod congue in et metus</p>
                                                    <small>yesterday</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notifications-dropdown-item">
                                                <div class="notifications-dropdown-item-image">
                                                    <span class="notifications-badge">
                                                        <img src="{{ asset('images/avatars/avatar.png') }}" alt="">
                                                    </span>
                                                </div>
                                                <div class="notifications-dropdown-item-text">
                                                    <p>Praesent sodales lobortis velit ac pellentesque</p>
                                                    <small>yesterday</small>
                                                </div>
                                            </div>
                                        </a>
                                        <a href="#">
                                            <div class="notifications-dropdown-item">
                                                <div class="notifications-dropdown-item-image">
                                                    <span class="notifications-badge">
                                                        <img src="{{ asset('images/avatars/avatar.png') }}" alt="">
                                                    </span>
                                                </div>
                                                <div class="notifications-dropdown-item-text">
                                                    <p>Praesent lacinia ante eget tristique mattis. Nam sollicitudin velit sit amet auctor porta</p>
                                                    <small>yesterday</small>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </li>
                        </ul>
                    </div> --}}
                </div>
            </nav>
        </div>
        @yield('content')
    </div>
</div>