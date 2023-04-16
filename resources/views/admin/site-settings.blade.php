@extends('admin.layouts.index')

@section('title', "$title - Site Settings")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="page-description page-description-tabbed">
                        <h1 id="">Website Settings</h1>

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="hoaccountme" aria-selected="true">Website Settings/Preferences</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">Payment Settings</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="integrations-tab" data-bs-toggle="tab" data-bs-target="#integrations" type="button" role="tab" aria-controls="integrations" aria-selected="false">Subscription Fees</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            {{-- Success message start  --}}
            @if (session()->has('success'))
                <div class="text-center alert alert-success">
                    {{ session()->get('success') }}
                </div>
            @endif

            {{-- If there are any errors  --}}
            @if ($errors->any())
                <div class="alert alert-custom alert-indicator-top indicator-danger mt-3" role="alert">
                    <div class="alert-content">
                        <span class="alert-title">Whoops!</span>
                        <ul>
                            @foreach ($errors->all() as $error)
                                <span class="alert-text">{{ $error }}</span>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif 
            {{-- End error messages  --}}

            <div class="row">
                <div class="col">
                    <div class="tab-content" id="myTabContent">
                        {{-- FIRST FORM HERE --}}

                            <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                                <div class="card">
                                    <div class="card-body">
                                        <form action="{{ route('editSitePreferences') }}" method="post">
                                            @csrf
                                            <div class="row">
                                                <label for="minimum_withdrawal" class="form-label">Minimum Withdrawal:</label>
                                                <input name="minimum_withdrawal" value="{{ $siteSettings->minimum_withdrawal }}" type="number" class="form-control" id="minimum_withdrawal" aria-describedby="emailHelp">
                                                <div id="" class="form-text"></div>
                                            </div>
                                            <div class="row mt-2">
                                                <label for="referral_bonus_1" class="form-label">Referral Bonus (1st User):</label>
                                                <input name="referral_bonus_first" value="{{ $siteSettings->referral_bonus_first }}" type="number" class="form-control" id="referral_bonus_1" aria-describedby="">
                                                <div id="" class="form-text"></div>
                                            </div>
                                            <div class="row mt-2">
                                                <label for="referral_bonus_2" class="form-label">Referral Bonus (2nd User):</label>
                                                <input name="referral_bonus_second" value="{{ $siteSettings->referral_bonus_second }}" type="number" class="form-control" id="referral_bonus_2" aria-describedby="">
                                                <div id="" class="form-text"></div>
                                            </div>
                                            <div class="row mt-2">
                                                <label for="referral_bonus_3" class="form-label">Referral Bonus (3rd User):</label>
                                                <input name="referral_bonus_third" value="{{ $siteSettings->referral_bonus_third }}" type="number" class="form-control" id="referral_bonus_3" aria-describedby="">
                                                <div id="" class="form-text"></div>
                                            </div>
                                            <div class="row m-t-lg">
                                                <div class="col">
                                                    <input type="submit" value="Update" class="btn btn-primary m-t-sm">
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
                                        <h5>Withdrawal Methods</h5>
                                        <span>Add withdrawal methods to be used in your website here.</span>
                                    </div>
                                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                        Add WIthdrawal Method
                                    </button>
                                
                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Add new withdrawal method</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <form action="{{ route('addWithdrawalMethod') }}" method="post">
                                                        @csrf
                                                        @method('POST')
                                                        <div class="row">
                                                            <div class="col-md-12 mt-2">
                                                                <label for="methodName" class="form-label">Method Name</label>
                                                                <input type="text" name="method_name" class="form-control" aria-describedby="settingsCurrentPassword" >
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mt-2">
                                                                <label for="settingsNewPassword" class="form-label">Minimum Amount</label>
                                                                <input type="text" name="minimum_amount" class="form-control" aria-describedby="settingsNewPassword">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mt-2">
                                                                <label for="settingsNewPassword" class="form-label">Maximum Amount</label>
                                                                <input type="text" name="maximum_account" class="form-control" aria-describedby="settingsNewPassword">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mt-2">
                                                                <label for="settingsNewPassword" class="form-label">Charges (Fixed amount $)</label>
                                                                <input type="text" name="charges_amount" class="form-control" aria-describedby="settingsNewPassword">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mt-2">
                                                                <label for="settingsNewPassword" class="form-label">Charges (Percentage %)</label>
                                                                <input type="text" name="charges_percentage" class="form-control" aria-describedby="settingsNewPassword">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mt-2">
                                                                <label for="payout_duration" class="form-label">Payout duration (Days)</label>
                                                                <input type="number" class="form-control" name="payout_duration" id="">
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12 mt-2">
                                                                <label for="settingsNewPassword" class="form-label">Enable/Disable</label>
                                                                <select name="status" class="js-states form-control" id="status" tabindex="-1" style=" width: 100%">
                                                                    <option value="Enabled">Enable</option>
                                                                    <option value="Disabled">Disable</option>
                                                                    </optgroup>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <input type="submit" value="Create" class="btn btn-primary mt-4">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        @forelse ($wdmethods as $wdmethod)
                                            <div class="col-md-4">
                                                <div class="card widget widget-info-navigation mt-3">
                                                    <div class="card-body">
                                                        <div class="widget-info-navigation-container">
                                                            <div class="widget-info-navigation-content">
                                                                <span class="text-muted">{{ $wdmethod->method_name }}</span><br>
                                                                <span class="text-dark fw-bolder fs-2">{{ $wdmethod->status }}</span>
                                                            </div>
                                                            <div class="widget-info-navigation-action">
                                                                <a href="#" class="btn btn-light btn-rounded"><i class="material-icons no-m">arrow_right_alt</i></a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @empty
                                        @endforelse
                                    </div>

                                    {{-- <div class="row m-t-xxl">
                                        <div class="col-md-12">
                                            <label for="settingsCurrentPassword" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" aria-describedby="settingsCurrentPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                            <div id="settingsCurrentPassword" class="form-text">Never share your password with anyone.</div>
                                        </div>
                                    </div>
                                    <div class="row m-t-xxl">
                                        <div class="col-md-12">
                                            <label for="settingsNewPassword" class="form-label">New Password</label>
                                            <input type="password" class="form-control" aria-describedby="settingsNewPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                        </div>
                                    </div>
                                    <div class="row m-t-xxl">
                                        <div class="col-md-12">
                                            <label for="settingsConfirmPassword" class="form-label">Confirm Password</label>
                                            <input type="password" class="form-control" aria-describedby="settingsConfirmPassword" placeholder="&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;&#9679;">
                                        </div>
                                    </div>
                                    <div class="row m-t-xxl">
                                        <div class="col-md-12">
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
                                    </div> --}}
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    {{-- <div class="settings-security-two-factor">
                                        <h5>Edit Payment Details</h5>
                                        <span>Payment details to be used when a user is making a deposit are to be edited here.</span>
                                    </div> --}}
                                    {{-- <form action="{{ route('editPaymentDetails') }}" method="post">
                                        @csrf
                                        <div class="accordion accordion-separated" id="accordionSeparatedExample">
                                            <div class="accordion-item mt-3">
                                                <h2 class="accordion-header" id="headingSeparatedOne">
                                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeparatedOne" aria-expanded="true" aria-controls="collapsSeparatedeOne">
                                                        Bank Transfer
                                                    </button>
                                                </h2>
                                                <div id="collapseSeparatedOne" class="accordion-collapse collapse show" aria-labelledby="headingSeparatedOne" data-bs-parent="#accordionExample">
                                                    <div class="accordion-body">
                                                        <label for="bank_name" class="form-label">Bank Name</label>
                                                        <input type="text" value="{{ $bankDetail->bank_name }}" name="bank_name" class="form-control" id="bank_name">

                                                        <label for="bank_account_name" class="form-label">Account Name</label>
                                                        <input type="text" value="{{ $bankDetail->bank_account_name }}" name="bank_account_name" class="form-control" id="bank_account_name">

                                                        <label for="bank_account_number" class="form-label">Account Number</label>
                                                        <input type="text" value="{{ $bankDetail->bank_account_number }}" name="bank_account_number" class="form-control" id="bank_account_number">
                                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSeparatedTwo">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeparatedTwo" aria-expanded="false" aria-controls="collapseSeparatedTwo">
                                                        Bitcoin
                                                    </button>
                                                </h2>
                                                <div id="collapseSeparatedTwo" class="accordion-collapse collapse" aria-labelledby="headingSeparatedTwo" data-bs-parent="#accordionSeparatedExample">
                                                    <div class="accordion-body">
                                                        <input type="text" value="{{ $btcDetail->btc_address }}" name="btc_address" class="form-control" id="">
                                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="accordion-item">
                                                <h2 class="accordion-header" id="headingSeparatedThree">
                                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSeparatedThree" aria-expanded="false" aria-controls="collapseSeparatedThree">
                                                        Ethereum
                                                    </button>
                                                </h2>
                                                <div id="collapseSeparatedThree" class="accordion-collapse collapse" aria-labelledby="headingSeparatedThree" data-bs-parent="#accordionSeparatedExample">
                                                    <div class="accordion-body">
                                                        <input type="text" value="{{ $ethDetail->eth_address }}" name="eth_address" class="form-control" id="">
                                                        <button type="submit" class="btn btn-primary mt-2">Submit</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form> --}}
                                    <div class="settings-security-two-factor mt-4">
                                        <h5>System Payment Mode</h5>
                                        <span>Edit payment details status to be shown to users here.</span>
                                    </div>
                                    <form action="{{ route('editPaymentStatus') }}" method="post" class="mt-4">
                                        @csrf
                                        @forelse ($paymentDetails as $paymentDetail)
                                        <div class="form-check">
                                            <input name="{{ $paymentDetail->identifier }}" value="true" {{ $paymentDetail->status ? 'checked' : '' }} class="form-check-input" type="checkbox" id="{{ $paymentDetail->id }}">
                                            <label class="form-check-label" for="{{ $paymentDetail->id }}">
                                                {{ $paymentDetail->name }}
                                            </label>
                                        </div>
                                        @empty
                                        @endforelse
                                        <input type="submit" class="btn btn-primary mt-2" value="Submit">
                                    </form>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="integrations-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="settings-integrations">
                                        <div class="settings-integrations-item">
                                            <div class="settings-integrations-item-info">
                                                <span>Allow withdrawals?</span>
                                            </div>
                                            <div class="settings-integrations-item-switcher">
                                                <form action="{{ route('allowWithdrawals') }}" id="allow_withdrawals_form" method="post">
                                                    @csrf
                                                    <div class="form-check form-switch">
                                                        <input name="allow_withdrawals" {{ $siteSettings->allow_withdrawals ? "checked" : "" }} class="form-check-input form-control-md" type="checkbox" id="settingsIntegrationTwoSwitcher" onclick="document.getElementById('allow_withdrawals_form').submit();">
                                                    </div>
                                                </form>
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
    </div>
</div>
@endsection