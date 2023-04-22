@extends('user.layouts.index')

@section('title', "$title - Dashboard")
@section('content')
<div class="app-content">
<div class="content-wrapper">
    <div class="container">
        <div class="row">
            <div class="col">
                <div class="page-description">
                    <h1>@lang('messages.dashboard')</h1>
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
        @if (session()->has('message'))
        <div class="text-center alert alert-success">
            {{ session()->get('message') }}
        </div>
        @endif
        <div class="row">
            <div class="col-xl-4">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-primary">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.balance')</span>
                                <span class="widget-stats-amount">${{ $balance }}</span>
                                <span class="widget-stats-info"></span>
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-negative align-self-start">
                                <i class="material-icons">keyboard_arrow_down</i> 4%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-primary">
                                <i class="material-icons-outlined">paid</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.deposits')</span>
                                <span class="widget-stats-amount">${{ $deposits }}</span>
                                {{-- <span class="widget-stats-info">{{ $depositsCount }} {{ Str::of('deposit')->plural($depositsCount) }} (Processed and pending inclusive)</span> --}}
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-negative align-self-start">
                                <i class="material-icons">keyboard_arrow_down</i> 4%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-warning">
                                <i class="material-icons-outlined">new_label</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.profits')</span>
                                <span class="widget-stats-amount">${{ $profit }}</span>
                                {{-- <span class="widget-stats-info">790 unique this month</span> --}}
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 12%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-4">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-warning">
                                <i class="material-icons-outlined">groups</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.referralBonus')</span>
                                <span class="widget-stats-amount">${{ $referralBonus }}</span>
                                <span class="widget-stats-info"></span>
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 12%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-4">
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-stats-container d-flex">
                            <div class="widget-stats-icon widget-stats-icon-danger">
                                <i class="material-icons-outlined">inventory_2</i>
                            </div>
                            <div class="widget-stats-content flex-fill">
                                <span class="widget-stats-title">@lang('messages.totalPackages')</span>
                                <span class="widget-stats-amount">{{ $plansCount }}</span>
                                <span class="widget-stats-info"></span>
                            </div>
                            {{-- <div class="widget-stats-indicator widget-stats-indicator-positive align-self-start">
                                <i class="material-icons">keyboard_arrow_up</i> 7%
                            </div> --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection