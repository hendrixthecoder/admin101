@extends('admin.auth.layout')

@section('title', "Login")
@section('content')
<div class="app app-auth-sign-in align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background"></div>
    <div class="app-auth-container">
        <div class="logo">
            <a href="{{ env('ADMIN_APP_URL') }}/dashboard">{{ env('APP_NAME') }}</a>
        </div>
        <p class="auth-description">Please sign-in to your account and continue to the dashboard.<br>Don't have an account? <a href="{{ route('showAdminRegisterForm') }}">Sign Up</a></p>
            @if(count($errors) > 0 )
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    {{-- <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button> --}}
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

        <form action="{{ route('logAdminIn') }}" id="logAdminUserIn" class="auth-credentials m-b-xxl" method="post">
            @csrf
            <label for="signInEmail" class="form-label">Email address</label>
            <input name="email" type="email" class="form-control m-b-md" id="signInEmail" aria-describedby="signInEmail" placeholder="example@neptune.com">
            <label for="signInPassword" class="form-label">Password</label>
            <input name="password" type="password" class="form-control" id="signInPassword" aria-describedby="signInPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">            
            <a href="" onclick="event.preventDefault();document.getElementById('logAdminUserIn').submit();" class="btn btn-primary auth-submit mt-4">Sign In</a>
            {{-- <form id="logUserIn" action="{{ route('logUserIn') }}" method="post">
            @csrf
            </form> --}}
            <a href="{{ route('password.request') }}" role="button" class="mt-4 auth-forgot-password float-end">Forgot password?</a>
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