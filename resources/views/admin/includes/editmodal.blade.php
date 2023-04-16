<div class="modal fade" id="edit" aria-hidden="true" aria-labelledby="" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <form action="{{ route('user.update', ['user' => $user->id]) }}" method="post" id="bio_data_form">
                @csrf
                @method('PUT')
                <div class="card">
                    <div class="card-body">
                        <div class="row m-t-lg">
                            <div class="col">
                                <div class="card-title">
                                    <h5>Edit user information</h5>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <input type="hidden" name="id" value="{{ $user->id }}">
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
                                <label for="settingsState" class="form-label ">State</label>
                                <select class="js-states form-control" id="settingsState" tabindex="-1" style=" width: 100%">
                                    <optgroup label="Alaskan/Hawaiian Time Zone">
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
                                <label for="settingsPassword" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="settingsPassword" maxlength="500" rows="4" aria-describedby="settingsAboutHelp">
                                <div id="emailHelp" class="form-text">Password should no be less than 8 characters</div>
                            </div>
                        </div>
                        <div class="row m-t-lg">
                            <div class="col">
                                <label for="settingsAbout" class="form-label">About</label>
                                <textarea name="about" class="form-control" id="settingsAbout" maxlength="500" rows="4" aria-describedby="settingsAboutHelp"></textarea>
                            </div>
                        </div>
                        <div class="row m-t-lg">
                            <div class="col">
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
            </form>

        </div>
    </div>
</div>