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
                <div class="col">
                    <div class="page-description">
                        <h1>@lang('messages.yourPackageText')</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($plans as $plan)
                <div class="col-xl-4">
                    <div class="card widget widget-list">
                        <div class="card-header">
                            <h5 class="card-title">{{ $plan->plan_name }}<span class="badge badge-info badge-style-light">FIXED PRICE</span></h5>
                        </div>
                        <div class="card-body">
                            <span class="text-muted m-b-xs d-block">PLAN AMOUNT: ${{ $plan->amount }}</span>
                            <ul class="widget-list-content list-unstyled">
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Amount Invested:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">${{ $plan->pivot->amount }}</span>
                                </li> 
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Status:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">ACTIVE!</span>
                                </li>
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Duration:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">{{ $plan->duration }}</span>
                                </li>  
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Date Joined:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">{{ $plan->created_at }}</span>
                                </li>                                                                     
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Pay Day:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">{{ $plan->pivot->pay_day }}</span>
                                </li>                                                                     
                            </ul>
                        </div>
                    </div>
                </div>
                @empty
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
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection