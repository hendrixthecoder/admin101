@extends('auth.layout')

@section('title', "$title - Create account")
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
                <div class="col-sm-6 mx-auto text-center">
                    <h1 class="mb-4"><a style="text-decoration: none;" href="{{ env('APP_URL') }}">{{ env('APP_NAME') }}</a></h1>
                </div>
            </div>

            @if(count($errors) > 0 )
            <div class="row">
            <div class="col-sm-8 mx-auto">
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <ul class="p-0 m-0" style="list-style: none;">
                        @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="card col-sm-8 mx-auto">
                        <div class="card-body">
                            <div class="card-title">
                                <p class="auth-description">Please enter your credentials to create an account.<br>Already have an account? <a href="{{ route('logUserInForm') }}">Sign In</a></p>
                            </div>
                            <form action="{{ route('storeUser') }}" method="post" class="auth-credentials m-b-xxl" id="reg-form">
                                @csrf
                                <input type="hidden" name="referred_by" value="{{ Session::get('user_id') }}">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="settingsInputEmail" class="form-label">Email address</label>
                                        <input name="email" required value="{{ old('email') }}" type="email" class="form-control" id="settingsInputEmail" aria-describedby="settingsEmailHelp" placeholder="example@neptune.com">
                                        <div id="settingsEmailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsPhoneNumber" class="form-label">Phone Number</label>
                                        <input name="p_number" required type="text" value="{{ old('p_number') }}" class="form-control" id="settingsPhoneNumber" placeholder="(xxx) xxx-xxxx">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsInputFirstName" class="form-label">First Name</label>
                                        <input name="f_name" required value="{{ old('f_name') }}" type="text" class="form-control" id="settingsInputFirstName" placeholder="John">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsInputLastName" class="form-label">Last Name</label>
                                        <input name="l_name" required type="text" value="{{ old('l_name') }}" class="form-control" id="settingsInputLastName" placeholder="Doe">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsInputUserName" class="form-label">Username</label>
                                        <div class="input-group">
                                            <input name="username" required value="{{ old('username') }}" type="text" class="form-control" id="settingsInputUserName" aria-describedby="settingsInputUserName-add" placeholder="Username">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="country" class="form-label">Country</label>
                                        <select required class="form-control" required name="country" id="country" tabindex="-1" style="width: 100%">
                                            <option value="">Select Country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country }}">{{ $country }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="signUpPassword" class="form-label">Password</label>
                                        <input type="password" required name="password" class="form-control" id="signUpPassword" aria-describedby="signUpPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                    </div>
                                    @if ($key ?? '')                                        
                                        <div class="col-md-6">
                                            <label for="settingsInputLastName" class="form-label">Referral Number</label>
                                            <input name="referral_id" readonly value="{{ $key }}" type="text" class="form-control" id="settingsInputLastName" placeholder="Put in referral number here (Optional)">
                                        </div>
                                    @else
                                        <div class="col-md-6">
                                            <label for="settingsInputLastName" class="form-label">Referral Number</label>
                                            <input name="referral_id" value="" type="text" class="form-control" id="settingsInputLastName" placeholder="Put in referral number here (Optional)">
                                        </div>
                                    @endif
                                </div>
                                <input type="submit" value="Submit" class="btn btn-primary auth-submit mt-4">
                                {{-- <a href="" class="btn btn-primary auth-submit mt-4" onclick="event.preventDefault();document.getElementById('reg-form').submit();">Sign Up</a> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection