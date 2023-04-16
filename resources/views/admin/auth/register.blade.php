@extends('auth.layout')

@section('title', "$title - Create admin account ")
@section('content')
<div class="app app-auth-sign-up align-content-stretch d-flex flex-wrap justify-content-end">
    <div class="app-auth-background">

    </div>
    {{-- @if (Request::path()=='admin/register')
        
    @else
        
    @endif --}}

    <div class="app-auth-container">
        <div class="logo mt-5">
            <a href="{{ env('ADMIN_APP_URL') }}/dashboard">{{ env('APP_NAME') }}</a>
        </div>
        <p class="auth-description">Please enter your credentials to create an account.<br>Already have an account? <a href="{{ route('login') }}">Sign In</a></p>
        @if(count($errors) > 0 )
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="p-0 m-0" style="list-style: none;">
                @foreach($errors->all() as $error)
                <li>{{$error}}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <form action="{{ route('storeAdminUser') }}" method="post" class="auth-credentials m-b-xxl" id="reg-form">
            @csrf
            <label for="signUpUsername" class="form-label">Username</label>
            <input type="email" name="username" class="form-control m-b-md" id="signUpUsername" aria-describedby="signUpUsername" placeholder="Enter username">

            <label for="signUpEmail" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control m-b-md" id="signUpEmail" aria-describedby="signUpEmail" placeholder="example@neptune.com">
            
            <label for="signUpPassword" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="signUpPassword" aria-describedby="signUpPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
            <div id="emailHelp" class="form-text">Password must be minimum 8 characters length*</div>

            <a href="" class="btn btn-primary auth-submit mt-4" onclick="event.preventDefault();document.getElementById('reg-form').submit();">Sign Up</a>
        </form>


        <div class="auth-submit">
        </div>

        <div class="divider"></div>
        {{-- <div class="auth-alts">
            <a href="#" class="auth-alts-google"></a>
            <a href="#" class="auth-alts-facebook"></a>
            <a href="#" class="auth-alts-twitter"></a>
        </div> --}}
    </div>
</div>
@endsection