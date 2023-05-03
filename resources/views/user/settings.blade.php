@extends('user.layouts.index')

@section('title', "$title - Edit Profile")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="page-description page-description-tabbed">
                        <h1 id="">@lang('messages.settings')</h1>

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="hoaccountme" aria-selected="true">@lang('messages.account')</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">@lang('messages.security')</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="integrations-tab" data-bs-toggle="tab" data-bs-target="#integrations" type="button" role="tab" aria-controls="integrations" aria-selected="false">@lang('messages.kyc')</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            
            @if (Session::has('successTrans'))
            <div class="row">
                <div class="col-xl-4">
                    <div class="alert alert-success">
                        <h4 class="text-center">
                            {{ Session::get('successTrans') }}
                        </h4>
                    </div>
                </div>
            </div>
            @endif
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
            @if (session()->has('error'))
                <div class="text-center alert alert-danger">
                    {{ session()->get('error') }}
                </div>
            @endif
            @if (session()->has('success'))
                <div class="text-center alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="tab-content" id="myTabContent">
                        {{-- FIRST FORM HERE --}}
                            <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('user.update', ['user' => Auth::user()]) }}" id="bio_data_form" method="post" enctype="multipart/form-data">
                                            @csrf
                                            @method('PUT')
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="settingsInputEmail" class="form-label">@lang('messages.emailAddress')</label>
                                                    <input name="email" value="{{ $user->email }}" type="email" class="form-control" id="settingsInputEmail" aria-describedby="settingsEmailHelp" placeholder="example@neptune.com">
                                                    <div id="settingsEmailHelp" class="form-text">@lang('messages.neverShareEmail')</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="settingsPhoneNumber" class="form-label">@lang('messages.phoneNumber')</label>
                                                    <input name="p_number" value="{{ $user->p_number }}" type="text" class="form-control" id="settingsPhoneNumber" placeholder="(xxx) xxx-xxxx">
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-6">
                                                    <label for="settingsInputFirstName" class="form-label">@lang('messages.firstName')</label>
                                                    <input name="f_name" value="{{ $user->f_name }}" type="text" class="form-control" id="settingsInputFirstName" placeholder="John">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="settingsInputLastName" class="form-label">@lang('messages.lastName')</label>
                                                    <input name="l_name" value="{{ $user->l_name }}" type="text" class="form-control" id="settingsInputLastName" placeholder="Doe">
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-6">
                                                    <label for="settingsInputUserName" class="form-label">@lang('messages.username')</label>
                                                    <div class="input-group">
                                                        <input name="username" value="{{ $user->username }}" type="text" class="form-control" id="settingsInputUserName" aria-describedby="settingsInputUserName-add" placeholder="Username">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-6">
                                                    <label for="settingsInputUserName" class="form-label">Profile Picture</label>
                                                    <div class="input-group">
                                                        <input name="pfp" type="file" class="form-control" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col">
                                                    <a href="#" class="btn btn-primary m-t-sm" 
                                                        onclick="event.preventDefault();
                                                                document.getElementById('bio_data_form').submit();">
                                                        @lang('messages.submit')
                                                    </a>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        {{-- SECOND FORM --}}
                        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="settings-security-two-factor">
                                        <h5>@lang('messages.passComp')</h5>
                                        <span>@lang('messages.changePass')</span>
                                    </div>
                                    <form action="{{ route('userChangePassword') }}" method="post" id="change_password_form">
                                        @csrf
                                        <div class="row m-t-xxl">
                                            <div class="col-md-6">
                                                <label for="settingsCurrentPassword" class="form-label">@lang('messages.currentPass')</label>
                                                <input required type="password" name="oldPassword" class="form-control" aria-describedby="settingsCurrentPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                                <div id="settingsCurrentPassword" class="form-text">@lang('messages.neverSharePass')</div>
                                            </div>
                                        </div>
                                        <div class="row m-t-xxl">
                                            <div class="col-md-6">
                                                <label for="settingsNewPassword" class="form-label">@lang('messages.newPass')</label>
                                                <input required type="password" name="password" class="form-control" aria-describedby="settingsNewPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                            </div>
                                        </div>
                                        <div class="row m-t-xxl">
                                            <div class="col-md-6">
                                                <label for="settingsConfirmPassword" class="form-label">@lang('messages.confirmPass')</label>
                                                <input type="password" required name="password_confirmation" class="form-control" aria-describedby="settingsConfirmPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                                <input type="hidden" name="g12" value="{{ Auth::user()->id }}">
                                            </div>
                                        </div>
                                        <div class="row m-t-lg">
                                            <div class="col">
                                                <input type="submit" class="btn btn-primary m-t-sm" value="@lang('messages.submit')">
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="integrations-tab">
                            <div class="card">
                                @if ($user->kyc_status == 'Unverified' || $user->kyc_status == 'Failed')
                                    <div class="card-header">
                                        <div class="settings-security-two-factor">
                                            <h5>@lang('messages.verifyKyc')</h5>
                                        </div>
                                        @if ($user->kyc_status == 'Failed')
                                            <h5 class="card-title mt-5">@lang('messages.kycStatus')<span class="badge badge-danger badge-style-light">@lang('messages.failed')</span></h5>
                                        @endif
                                    </div>  
                                    <div class="card-body">
                                        <form action="{{ route('setKyc') }}" method="post" class="m-t-xxl" enctype="multipart/form-data">
                                            @csrf
                                            <label for="idcard" class="mb-2">@lang('messages.idCard')</label>
                                            <input type="file" name="idcard" class="form-control" id="idcard" required>

                                            <label for="photo" class="mt-4 mb-2">@lang('messages.photo')</label>
                                            <input type="file" name="photo" class="form-control mb-4" id="photo" required>

                                            <input type="submit" value="@lang('messages.submit')" class="btn btn-primary">
                                        </form>
                                    </div>
                                @elseif ($user->kyc_status == 'Submitted')  
                                    <div class="card-header">
                                        <h5 class="card-title mb-3">@lang('messages.kycStatus')<span class="badge badge-info badge-style-light">@lang('messages.submitted')</span></h5>
                                    </div>
                                @elseif ($user->kyc_status == 'Verified')
                                    <div class="card-header">
                                        <h5 class="card-title mb-3">@lang('messages.kycStatus')<span class="badge badge-success badge-style-light">@lang('messages.verified')</span></h5>
                                    </div>
                                @endif
                                
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection