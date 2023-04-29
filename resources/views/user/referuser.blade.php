@extends('user.layouts.index')

@section('title', "$title - Refer Users")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
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
                    <div class="page-description text-center">
                        <h1>@lang('messages.joinCommunity')</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12">
                    <div class="card widget">
                        <div class="card-header">
                            <h5 class="card-title">@lang('messages.referralLink')</h5>
                        </div>
                        <div class="card-body">
                            <p class="text-muted d-block">@lang('messages.welcomeRefer')</p>
                            <p><strong>{{ $user->referral_key }}</strong></p>
                            <p class="text-muted d-block">{{ $referee ?? '' }}</p>    
                            <div class="input-group">
                                <input type="disabled" id="referral_link_share" class="form-control form-control-solid-bordered" value="{{ env('APP_URL') }}account/refer/{{ $user->referral_key }}" aria-label="{{ env('APP_URL') }}account/refer/{{ $user->referral_key }}" aria-describedby="share-link1">
                                <button class="btn btn-primary" type="button" id="share-link1"><i class="material-icons no-m fs-5">content_copy</i></button>
                            </div>
                            
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title">@lang('messages.yourReferrals')</h5>
                        </div>
                        <div class="card-body">
                            <table id="datatable1" class="display nowrap" style="width:100%">
                                <thead>
                                    <tr>
                                        <th>Username</th>
                                        <th>Email</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($referrals as $referral)
                                    <tr>
                                        <td>{{ $referral->username }}</td>
                                        <td>{{ $referral->email }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    $('#share-link1').click(function(){
    "use strict";
        var copyText = document.getElementById("referral_link_share");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        /*For mobile devices*/
        document.execCommand("copy");
        
        alert('Referral Link Copied');
  });
</script>
@endsection
