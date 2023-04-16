@extends('admin.layouts.index')

@section('title',"$title - Update Account")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="page-description page-description-tabbed">
                        <h1 id="">Profile Settings</h1>

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="hoaccountme" aria-selected="true">Account</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">Security</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="integrations-tab" data-bs-toggle="tab" data-bs-target="#integrations" type="button" role="tab" aria-controls="integrations" aria-selected="false">Integrations</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            @if (session()->has('message'))
                <div class="text-center alert alert-success">
                    {{ session()->get('message') }}
                </div>
            @endif
            <form action="{{ route('adminEditProfileStore') }}" id="bio_data_form" method="post">
                @csrf
                @method('PUT')
                <div class="row">
                    <div class="col">
                        <div class="tab-content" id="myTabContent">
                            {{-- FIRST FORM HERE --}}
    
                                <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <label for="settingsInputEmail" class="form-label">Email address</label>
                                                    <input name="email" value="{{ $user->email }}" type="email" class="form-control" id="settingsInputEmail" aria-describedby="settingsEmailHelp" placeholder="example@neptune.com">
                                                    <div id="settingsEmailHelp" class="form-text">We'll never share your email with anyone else.</div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="settingsPhoneNumber" class="form-label">Phone Number</label>
                                                    <input name="p_number" value="{{ $user->p_number }}" type="text" class="form-control" id="settingsPhoneNumber" placeholder="(xxx) xxx-xxxx">
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-6">
                                                    <label for="settingsInputFirstName" class="form-label">First Name</label>
                                                    <input name="f_name" value="{{ $user->f_name }}" type="text" class="form-control" id="settingsInputFirstName" placeholder="John">
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="settingsInputLastName" class="form-label">Last Name</label>
                                                    <input name="l_name" value="{{ $user->l_name }}" type="text" class="form-control" id="settingsInputLastName" placeholder="Doe">
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col-md-6">
                                                    <label for="settingsInputUserName" class="form-label">Username</label>
                                                    <div class="input-group">
                                                        {{-- <span class="input-group-text" id="settingsInputUserName-add">neptune.com/</span> --}}
                                                        <input name="username" value="{{ $user->username }}" type="text" class="form-control" id="settingsInputUserName" aria-describedby="settingsInputUserName-add" placeholder="Username">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <label for="settingsState" class="form-label mt-4">State</label>
                                                    <select name="state" class="js-states form-control" id="settingsState" tabindex="-1" style=" width: 100%">
                                                        <optgroup label="Alaskan/Hawaiian Time Zone">
                                                            <option selected value="{{ $user->state }}">{{ $user->state }}</option>
                                                            <option value="AK">Alaska</option>
                                                            <option value="HI">Hawaii</option>
                                                        </optgroup>
                                                        <optgroup label="Pacific Time Zone">
                                                            <option value="CA">California</option>
                                                            <option value="NV">Nevada</option>
                                                            <option value="OR">Oregon</option>
                                                            <option value="WA">Washington</option>
                                                        </optgroup>
                                                        <optgroup label="Mountain Time Zone">
                                                            <option value="AZ">Arizona</option>
                                                            <option value="CO">Colorado</option>
                                                            <option value="ID">Idaho</option>
                                                            <option value="MT">Montana</option>
                                                            <option value="NE">Nebraska</option>
                                                            <option value="NM">New Mexico</option>
                                                            <option value="ND">North Dakota</option>
                                                            <option value="UT">Utah</option>
                                                            <option value="WY">Wyoming</option>
                                                        </optgroup>
                                                        <optgroup label="Central Time Zone">
                                                            <option value="AL">Alabama</option>
                                                            <option value="AR">Arkansas</option>
                                                            <option value="IL">Illinois</option>
                                                            <option value="IA">Iowa</option>
                                                            <option value="KS">Kansas</option>
                                                            <option value="KY">Kentucky</option>
                                                            <option value="LA">Louisiana</option>
                                                            <option value="MN">Minnesota</option>
                                                            <option value="MS">Mississippi</option>
                                                            <option value="MO">Missouri</option>
                                                            <option value="OK">Oklahoma</option>
                                                            <option value="SD">South Dakota</option>
                                                            <option value="TX">Texas</option>
                                                            <option value="TN">Tennessee</option>
                                                            <option value="WI">Wisconsin</option>
                                                        </optgroup>
                                                        <optgroup label="Eastern Time Zone">
                                                            <option value="CT">Connecticut</option>
                                                            <option value="DE">Delaware</option>
                                                            <option value="FL">Florida</option>
                                                            <option value="GA">Georgia</option>
                                                            <option value="IN">Indiana</option>
                                                            <option value="ME">Maine</option>
                                                            <option value="MD">Maryland</option>
                                                            <option value="MA">Massachusetts</option>
                                                            <option value="MI">Michigan</option>
                                                            <option value="NH">New Hampshire</option>
                                                            <option value="NJ">New Jersey</option>
                                                            <option value="NY">New York</option>
                                                            <option value="NC">North Carolina</option>
                                                            <option value="OH">Ohio</option>
                                                            <option value="PA">Pennsylvania</option>
                                                            <option value="RI">Rhode Island</option>
                                                            <option value="SC">South Carolina</option>
                                                            <option value="VT">Vermont</option>
                                                            <option value="VA">Virginia</option>
                                                            <option value="WV">West Virginia</option>
                                                        </optgroup>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col">
                                                    <label for="settingsAbout" class="form-label">About</label>
                                                    <input name="about" value="{{ $user->about }}" class="form-control" id="settingsAbout">
                                                    <div id="emailHelp" class="form-text">Brief information about you to display on profile (max: 500 characters)</div>
                                                </div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col">
                                                    <div class="form-check">
                                                        <input name="news_letter" class="form-check-input" type="checkbox" value="" id="SettingsNewsLetter">
                                                        <label class="form-check-label" for="SettingsNewsLetter">
                                                            Receive notifications about updates &amp; maintenances
                                                        </label>
                                                    </div>
                                                    <a href="#" class="btn btn-primary m-t-sm" 
                                                        onclick="event.preventDefault();
                                                                document.getElementById('bio_data_form').submit();
                                                                // document.body.scrollTop=0;
                                                                // document.documentElement.scrollTop=0">
                                                        Update
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- SECOND FORM --}}
                            <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="settings-security-two-factor">
                                            <h5>Two-Factor Authentication</h5>
                                            <span>Two-factor authentication is automatically enabled on your account, for security reasons we require all users to authenticate with SMS code or authorized third-party auth apps. Read more about our security policy <a href="#">here</a>.</span>
                                        </div>
                                        <div class="row m-t-xxl">
                                            <div class="col-md-6">
                                                <label for="settingsCurrentPassword" class="form-label">Current Password</label>
                                                <input type="password" class="form-control" aria-describedby="settingsCurrentPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                                <div id="settingsCurrentPassword" class="form-text">Never share your password with anyone.</div>
                                            </div>
                                        </div>
                                        <div class="row m-t-xxl">
                                            <div class="col-md-6">
                                                <label for="settingsNewPassword" class="form-label">New Password</label>
                                                <input type="password" class="form-control" aria-describedby="settingsNewPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                            </div>
                                        </div>
                                        <div class="row m-t-xxl">
                                            <div class="col-md-6">
                                                <label for="settingsConfirmPassword" class="form-label">Confirm Password</label>
                                                <input type="password" class="form-control" aria-describedby="settingsConfirmPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                            </div>
                                        </div>
                                        <div class="row m-t-xxl">
                                            <div class="col-md-6">
                                                <label for="settingsSmsCode" class="form-label">SMS Code</label>
                                                <div class="input-group">
                                                    <input type="password" class="form-control" aria-describedby="settingsSmsCode" placeholder="&#9679;&#9679;&#9679;&#9679;">
                                                    <button class="btn btn-primary btn-style-light" id="settingsResentSmsCode">Resend</button>
                                                </div>
                                                <div id="settingsSmsCode" class="form-text">Code will be sent to the phone number from your account.</div>
                                            </div>
                                        </div>
                                        <div class="row m-t-lg">
                                            <div class="col">
                                                <div class="form-check">
                                                    <input name="session_logout" class="form-check-input" type="checkbox" value="" id="settingsPasswordLogout" checked>
                                                    <label class="form-check-label" for="settingsPasswordLogout">
                                                        Log out from all current sessions
                                                    </label>
                                                </div>
                                                <a href="#" class="btn btn-primary m-t-sm">Change Password</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="integrations-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="settings-integrations">
                                            <div class="settings-integrations-item">
                                                <div class="settings-integrations-item-info">
                                                    <img src="../../assets/images/icons/jira_software.png" alt="">
                                                    <span>Plan, track, and manage your agile and software development projects in Jira.</span>
                                                </div>
                                                <div class="settings-integrations-item-switcher">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input form-control-md" type="checkbox" id="settingsIntegrationOneSwitcher" checked>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="settings-integrations-item">
                                                <div class="settings-integrations-item-info">
                                                    <img src="../../assets/images/icons/confluence.png" alt="">
                                                    <span>Build, organize, and collaborate on work in one place from virtually anywhere.</span>
                                                </div>
                                                <div class="settings-integrations-item-switcher">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input form-control-md" type="checkbox" id="settingsIntegrationTwoSwitcher" checked>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="settings-integrations-item">
                                                <div class="settings-integrations-item-info">
                                                    <img src="../../assets/images/icons/bitbucket.png" alt="">
                                                    <span>Build, test, and deploy with unlimited private or public space with Bitbucket.</span>
                                                </div>
                                                <div class="settings-integrations-item-switcher">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input form-control-md" type="checkbox" id="settingsIntegrationThreeSwitcher">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="settings-integrations-item">
                                                <div class="settings-integrations-item-info">
                                                    <img src="../../assets/images/icons/sourcetree.png" alt="">
                                                    <span>A Git GUI that offers a visual representation of your repositories.</span>
                                                </div>
                                                <div class="settings-integrations-item-switcher">
                                                    <div class="form-check form-switch">
                                                        <input class="form-check-input form-control-md" type="checkbox" id="settingsIntegrationFourSwitcher">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection