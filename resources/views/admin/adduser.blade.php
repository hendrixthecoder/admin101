@extends('admin.layouts.index')

@section('title', "$title - Manage Users")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Add new Users to {{ $title }} community</h1>

                        @if (session()->has('message'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Success!</span>
                                <span class="alert-text">{{ session()->get('message') }}</span>
                            </div>
                        </div>
                        @endif
                        @if ($errors->any())
                        <div class="alert alert-custom alert-indicator-top indicator-danger mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Error!</span>
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <span class="alert-text">{{ $error }}</span>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        @endif  
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="{{ route('storeUser') }}" id="bio_data_form" method="post">
                        @csrf
                        @method('POST')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="settingsInputEmail" class="form-label">Email address</label>
                                        <input name="email" type="email" class="form-control" id="settingsInputEmail" aria-describedby="settingsEmailHelp" placeholder="example@neptune.com">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsPhoneNumber" class="form-label">Phone Number</label>
                                        <input name="p_number" type="text" class="form-control" id="settingsPhoneNumber" placeholder="(xxx) xxx-xxxx">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsInputFirstName" class="form-label">First Name</label>
                                        <input name="f_name" type="text" class="form-control" id="settingsInputFirstName" placeholder="John">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsInputLastName" class="form-label">Last Name</label>
                                        <input name="l_name" type="text" class="form-control" id="settingsInputLastName" placeholder="Doe">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsInputUserName" class="form-label">Username</label>
                                        <div class="input-group">
                                            {{-- <span class="input-group-text" id="settingsInputUserName-add">neptune.com/</span> --}}
                                            <input name="username" type="text" class="form-control" id="settingsInputUserName" aria-describedby="settingsInputUserName-add" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsPassword" class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control" id="settingsPassword" maxlength="500" rows="4" aria-describedby="settingsAboutHelp">
                                        <div id="emailHelp" class="form-text">Password should no be less than 8 characters</div>
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col">
                                        <a href="#" class="btn btn-primary m-t-sm" 
                                            onclick="event.preventDefault();
                                                    document.getElementById('bio_data_form').submit();
                                                    // document.body.scrollTop=0;
                                                    // document.documentElement.scrollTop=0">
                                            Create
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection