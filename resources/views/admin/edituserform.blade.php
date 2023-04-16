@extends('admin.layouts.index')

@section('title', "$title - Edit User")

@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Update {{ $username }} profile</h1>

                        @if (session()->has('message'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Success!</span>
                                <span class="alert-text">{{ session()->get('message') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <form action="/admin/user/{{ $user->id }}" id="admin_edit_user_form" method="POST">
                        @csrf
                        @method('PUT')
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <label for="settingsInputEmail" class="form-label">Email address</label>
                                        <input name="email" type="email" class="form-control" id="settingsInputEmail" aria-describedby="settingsEmailHelp" placeholder="example@neptune.com" value="{{ $user->email }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsPhoneNumber" class="form-label">Phone Number</label>
                                        <input name="p_number" type="text" class="form-control" id="settingsPhoneNumber" placeholder="(xxx) xxx-xxxx" value="{{ $user->p_number }}">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsInputFirstName" class="form-label">First Name</label>
                                        <input name="f_name" type="text" class="form-control" id="settingsInputFirstName" placeholder="John" value="{{ $user->f_name }}">
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsInputLastName" class="form-label">Last Name</label>
                                        <input name="l_name" type="text" class="form-control" id="settingsInputLastName" placeholder="Doe" value="{{ $user->l_name }}">
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col-md-6">
                                        <label for="settingsInputUserName" class="form-label">Username</label>
                                        <div class="input-group">
                                            {{-- <span class="input-group-text" id="settingsInputUserName-add">neptune.com/</span> --}}
                                            <input name="username" type="text" class="form-control" id="settingsInputUserName" aria-describedby="settingsInputUserName-add" placeholder="Username" value="{{ $user->username }}">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <label for="settingsState" class="form-label ">State</label>
                                        <select name="state" class="js-states form-control" id="settingsState" tabindex="-1" style=" width: 100%" >
                                            <optgroup label="Alaskan/Hawaiian Time Zone">
                                                <option value="Alaska">Alaska</option>
                                                <option value="Hawaii">Hawaii</option>
                                            </optgroup>
                                            <optgroup label="Pacific Time Zone">
                                                <option value="California">California</option>
                                                <option value="Nevada">Nevada</option>
                                                <option value="Oregon">Oregon</option>
                                                <option value="Washington">Washington</option>
                                            </optgroup>
                                            <optgroup label="Mountain Time Zone">
                                                <option value="Arizona">Arizona</option>
                                                <option value="Colorado">Colorado</option>
                                                <option value="Idaho">Idaho</option>
                                                <option value="Montana">Montana</option>
                                                <option value="Nebraska">Nebraska</option>
                                                <option value="New Mexico">New Mexico</option>
                                                <option value="North Dakota">North Dakota</option>
                                                <option value="Utah">Utah</option>
                                                <option value="Wyoming">Wyoming</option>
                                            </optgroup>
                                            <optgroup label="Central Time Zone">
                                                <option value="Alabama">Alabama</option>
                                                <option value="Arkansas">Arkansas</option>
                                                <option value="Illinois">Illinois</option>
                                                <option value="Iowa">Iowa</option>
                                                <option value="Kansas">Kansas</option>
                                                <option value="Kentucky">Kentucky</option>
                                                <option value="Louisiana">Louisiana</option>
                                                <option value="Minnesota">Minnesota</option>
                                                <option value="Mississippi">Mississippi</option>
                                                <option value="Missouri">Missouri</option>
                                                <option value="Oklahoma">Oklahoma</option>
                                                <option value="South Dakota">South Dakota</option>
                                                <option value="Texas">Texas</option>
                                                <option value="Tennessee">Tennessee</option>
                                                <option value="Wisconsin">Wisconsin</option>
                                            </optgroup>
                                            <optgroup label="Eastern Time Zone">
                                                <option value="Connecticut">Connecticut</option>
                                                <option value="Delaware">Delaware</option>
                                                <option value="Florida">Florida</option>
                                                <option value="Georgia">Georgia</option>
                                                <option value="Indiana">Indiana</option>
                                                <option value="Maine">Maine</option>
                                                <option value="Maryland">Maryland</option>
                                                <option value="Massachusetts">Massachusetts</option>
                                                <option value="Michigan">Michigan</option>
                                                <option value="New Hampshir">New Hampshire</option>
                                                <option value="New Jersey">New Jersey</option>
                                                <option value="New York">New York</option>
                                                <option value="North Carolina<">North Carolina</option>
                                                <option value="Ohio">Ohio</option>
                                                <option value="Pennsylvania">Pennsylvania</option>
                                                <option value="Rhode Island">Rhode Island</option>
                                                <option value="South Carolina">South Carolina</option>
                                                <option value="Vermont">Vermont</option>
                                                <option value="Virginia">Virginia</option>
                                                <option value="West Virginia">West Virginia</option>
                                            </optgroup>
                                        </select>
                                    </div>
                                </div>
                                {{-- <div class="row m-t-lg">
                                    <div class="col">
                                        <label for="settingsPassword" class="form-label">Password</label>
                                        <input name="password" type="password" class="form-control" id="settingsPassword" maxlength="500" rows="4" aria-describedby="settingsAboutHelp">
                                        <div id="emailHelp" class="form-text">Password should no be less than 8 characters</div>
                                    </div>
                                </div> --}}
                                <div class="row m-t-lg">
                                    <div class="col">
                                        <label for="settingsAbout" class="form-label">About</label>
                                        <textarea value="{{ $user->about }}" name="about" class="form-control" id="settingsAbout" maxlength="500" rows="4" aria-describedby="settingsAboutHelp">

                                        </textarea>
                                    </div>
                                </div>
                                <div class="row m-t-lg">
                                    <div class="col">
                                        <a href="#" class="btn btn-primary m-t-sm" 
                                            onclick="event.preventDefault();
                                                    document.getElementById('admin_edit_user_form').submit();
                                                    // document.body.scrollTop=0;
                                                    // document.documentElement.scrollTop=0">
                                            Update
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