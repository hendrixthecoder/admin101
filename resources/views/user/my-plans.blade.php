@extends('user.layouts.index')

@section('title', "$title - My Plans")
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
                <div class="col-xl-8">
                    <div class="page-description">
                        <h1>@lang('messages.yourPackageText')</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($running_community_plans->isEmpty())
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-tweet-container">
                            <div class="widget-tweet-content">
                                <h3>@lang('messages.noPlans')</h3>
                            </div>
                        </div>
                        <div class="text-center">
                        </div>
                    </div>
                </div>
                @else
                <div class="col-xl-6">
                    <div class="card widget widget-list">
                        <div class="card-header">
                            <h5 class="card-title">Community Bot 🤖<span class="badge badge-info badge-style-light">FIXED PRICE</span></h5>
                        </div>
                        <div class="card-body">
                            {{-- <span class="text-muted m-b-xs d-block">PLAN AMOUNT: $</span> --}}
                            <ul class="widget-list-content list-unstyled">
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            How many packages owned:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">{{ $com_plan_count }}</span>
                                </li>                                                                  
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Total Profit Expected($):
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">{{ $total_comm_profit }}</span>
                                </li>                                                                  
                            </ul>
                        </div>
                    </div>
                </div>
                @endif
                
                @if ($running_personal_plans->isEmpty())
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-tweet-container">
                            <div class="widget-tweet-content">
                                <h3>@lang('messages.noPlans')</h3>
                            </div>
                        </div>
                        <div class="text-center">
                        </div>
                    </div>
                </div>
                @else
                <div class="col-xl-6">
                    <div class="card widget widget-list">
                        <div class="card-header">
                            <h5 class="card-title">Personal Bot Pro 🤖<span class="badge badge-info badge-style-light">FIXED PRICE</span></h5>
                        </div>
                    <div class="card-body">
                        {{-- <span class="text-muted m-b-xs d-block">PLAN AMOUNT: $</span> --}}
                        <ul class="widget-list-content list-unstyled">
                            <li class="widget-list-item widget-list-item-blue">
                                <span class="widget-list-item-description">
                                    <span class="widget-list-item-description-title">
                                        How many packages owned:
                                    </span>
                                </span>
                                <span class="widget-list-item-transaction-amount-positive">{{ $pers_plan_count }}</span>
                            </li>                                                                  
                            <li class="widget-list-item widget-list-item-blue">
                                <span class="widget-list-item-description">
                                    <span class="widget-list-item-description-title">
                                        Total Profit Expected($):
                                    </span>
                                </span>
                                <span class="widget-list-item-transaction-amount-positive">{{ $total_pers_profit }}</span>
                            </li>                                                                  
                        </ul>
                    </div>
                </div>
            </div>
            @endif
        </div>

        </div>
    </div>
</div>
@endsection