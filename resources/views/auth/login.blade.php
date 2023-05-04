@extends('auth.layout')

@section('title', "$title - Login")
@section('content')

<div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background"></div>
    <div class="app-auth-container">
        <div class="logo">
            <a style="text-decoration: none;" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a>
        </div>
        <p class="auth-description">Please sign-in to your account and continue to the dashboard.<br>Don't have an account? <a href="{{ route('showRegisterForm') }}">Sign Up</a></p>
            @if(count($errors) > 0 )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="p-0 m-0" style="list-style: none;">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session()->has('status'))
            <div class="text-center alert alert-success">
                {{ session()->get('status') }}
            </div>
            @endif

            <form action="{{ route('logUserIn') }}" id="logUserIn" class="auth-credentials m-b-xxl" method="post">
                @csrf
                <label for="signInEmail" class="form-label">Email address</label>
                <input name="email" required type="email" class="form-control m-b-md" id="signInEmail" aria-describedby="signInEmail" placeholder="example@marathn.com">

                <label for="signInPassword" class="form-label">Password</label>
                <input required name="password" type="password" class="form-control" id="signInPassword" aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">            
                
                <a href="{{ route('home') }}" onclick="event.preventDefault();document.getElementById('logUserIn').submit();" class="btn btn-primary auth-submit mt-4">Sign In</a>
                {{-- <form id="logUserIn" action="{{ route('logUserIn') }}" method="post">
                @csrf
                </form> --}}
                <a href="{{ route('password.request') }}" class="mt-4 auth-forgot-password float-end">Forgot password?</a>
            </form>

        <div class="divider"></div>
        {{-- <div class="auth-alts">
            <a href="#" class="auth-alts-google"></a>
            <a href="#" class="auth-alts-facebook"></a>
            <a href="#" class="auth-alts-twitter"></a>
        </div> --}}
    </div>
</div>

@endsection