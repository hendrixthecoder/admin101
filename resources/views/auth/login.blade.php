@extends('auth.layout')

@section('title', "$title - Login")
@section('content')

<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="card col-sm-8 mx-auto">
                    @if (session()->has('success'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Success!</span>
                                <span class="alert-text">{{ session()->get('success') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="card col-sm-8 mx-auto">
                    @if (session()->has('error'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Whoops!</span>
                                <span class="alert-text">{{ session()->get('error') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-sm-6 mx-auto text-center">
                    <h1 class="mb-4"><a style="text-decoration: none;" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a></h1>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if(count($errors) > 0 )
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <ul class="p-0 m-0" style="list-style: none;">
                            @foreach($errors->all() as $error)
                            <li>{{$error}}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card col-sm-8 mx-auto">
                        <div class="card-body">
                            <div class="card-title">
                                <p class="auth-description">Please enter your credentials to login.<br>Don't have an account? <a href="{{ route('showRegisterForm') }}">Sign Up</a></p>
        
                            </div>
                            <form action="{{ route('logUserIn') }}" id="logUserIn" class="auth-credentials m-b-xxl" method="post">
                                @csrf
                                <label for="signInEmail" class="form-label">Email address</label>
                                <input name="email" type="email" class="form-control m-b-md" id="signInEmail" aria-describedby="signInEmail" placeholder="example@marathn.com">
                                <label for="signInPassword" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="signInPassword" aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">            
                                <a href="{{ route('home') }}" onclick="event.preventDefault();document.getElementById('logUserIn').submit();" class="btn btn-primary auth-submit mt-4">Sign In</a>
                                {{-- <form id="logUserIn" action="{{ route('logUserIn') }}" method="post">
                                @csrf
                                </form> --}}
                                <a href="{{ route('password.request') }}" class="mt-4 auth-forgot-password float-end">Forgot password?</a>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection