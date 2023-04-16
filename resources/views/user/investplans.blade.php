@extends('user.layouts.index')

@section('title', "$title - Investment Plans")
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
                        <h1>@lang('messages.investmentPlans')</h1>
                        <span>@lang('messages.investPageList')</span>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-header">
                  @lang('messages.balance')
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>${{ $balance }}</p>
                    <footer class="blockquote-footer">@lang('messages.greatDay')</footer>
                  </blockquote>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if (session()->has('success'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Hurray!</span>
                                <span class="alert-text">{{ session()->get('success') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if (session()->has('error'))
                        <div class="alert alert-custom alert-indicator-top indicator-danger mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Whoops!</span>
                                <span class="alert-text">{{ session()->get('error') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @forelse ($plans as $plan)
                <div class="col-xl-4">
                    <div class="card widget widget-list">
                        <div class="card-header">
                            <h5 class="card-title">{{ $plan->plan_name }} 🤖<span class="badge badge-info badge-style-light">FIXED PRICE</span></h5>
                        </div>
                        <div class="card-body">
                            {{-- <span class="text-muted m-b-xs d-block">PLAN AMOUNT: ${{ $plan->amount }}</span> --}}
                            <ul class="widget-list-content list-unstyled">
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Minimum Possible Deposit:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">${{ $plan->min_deposit }}</span>
                                </li>
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Maximum Possible Deposit:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">${{ $plan->max_deposit }}</span>
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
                                            Amount($):
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive" style="max-width: 50%;">
                                        <form action="{{ route('joinPlan', ['id' => $plan->id]) }}" method="post" id="join_plan_form{{ $plan->id }}">
                                            @csrf
                                            <input name="amount" type="number" value="{{ $plan->min_deposit }}" class="form-control">
                                        </form>
                                    </span>
                                </li>                                    
                                <li>
                                    <div class="row">
                                        <button class="btn btn-primary mt-3" onclick="event.preventDefault();document.getElementById('join_plan_form{{ $plan->id }}').submit();">Join Plan</button>
                                    </div>
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
                                    <h3>There are currently no plans.</h3>
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