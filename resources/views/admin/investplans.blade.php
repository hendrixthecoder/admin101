@extends('admin.layouts.index')

@section('title', "$title - Edit Investment Plans")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <button type="button" class="btn btn-primary mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="material-icons-two-tone">add</i>Create New Plan
                    </button>

                    @if ($errors->any())
                        <div class="alert alert-custom alert-indicator-top indicator-danger" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Whoops!</span>
                                @foreach ($errors->all() as $error)
                                <span class="alert-text">{{ $error }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @if (session()->has('message'))
                    <div class="alert alert-custom alert-indicator-top indicator-success" role="alert">
                        <div class="alert-content">
                            <span class="alert-title">Success!</span>
                            <span class="alert-text">{{ session()->get('message') }}</span>
                        </div>
                    </div>
                    
                    @endif

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Make a new investment plan</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>  
                                <div class="modal-body">
                                    <form class="row g-3" id="createPlan" action="{{ route('investment-plans.store') }}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputPlanName" class="form-label">Plan Name</label>
                                            <input name="plan_name" type="text" class="form-control" id="inputPlanName" placeholder="Enter amount here" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="amount" class="form-label">Amount</label>
                                            <input name="amount" type="text" class="form-control" id="amount" placeholder="Enter plan name here" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="min_deposit" class="form-label">Minimum Deposit</label>
                                            <input name="min_deposit" type="text" class="form-control" id="min_deposit" placeholder="Enter maximun deposit here" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="max_deposit" class="form-label">Max Deposit</label>
                                            <input name="max_deposit" type="text" class="form-control" id="max_deposit" placeholder="Enter max deposit here" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="min_return" class="form-label">Minimum Return</label>
                                            <input name="min_return" type="text" class="form-control" id="min_return" placeholder="Enter minimum return here" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="max_return" class="form-label">Max Return</label>
                                            <input name="max_return" type="text" class="form-control" id="max_return" placeholder="Enter max return here" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="duration" class="form-label">Top Up Interval</label>
                                                <select class="form-control" name="top_up_interval" id="top_up_interval" required>
                                                  <option>Hourly</option>
                                                  <option>Daily</option>
                                                  <option>Weekly</option>
                                                  <option>Monthly</option>
                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="top_up_type" class="form-label">Top Up Type</label>
                                                <select class="form-control" name="top_up_type" id="top_up_type" required>
                                                  <option>Fixed</option>
                                                  <option>Percentage</option>
                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-12">
                                            <label for="top_up_value" class="form-label">Top Up Amount(in % or $ as specified above)</label>
                                            <input name="top_up_value" type="text" class="form-control" id="top_up_value" placeholder="Enter max return here" required>
                                        </div>
                                        <div class="col-12">
                                            <label for="gift_bonus" class="form-label">Gift Bonus</label>
                                            <input name="gift_bonus" type="text" class="form-control" id="gift_bonus" placeholder="Enter gift bonus here" required>
                                        </div>
                                        <div class="col-12">
                                            <div class="form-group">
                                                <label for="duration" class="form-label">Duration</label>
                                                <select class="form-control" name="duration" id="duration" required>
                                                  <option>One Week</option>
                                                  <option>One Month</option>
                                                  <option>3 Months</option>
                                                  <option>6 Months</option>
                                                  <option>1 Year</option>
                                                </select>
                                              </div>
                                        </div>
                                        <div class="col-12">
                                            <button type="submit" onclick="event.preventDefault();document.getElementById('createPlan').submit();" class="btn btn-primary">Create</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Available Plans</h1>
                    </div>
                </div>
            </div>

            {{-- LIST OF PLANS --}}
            <div class="row">
                @forelse ($plans as $plan)
                <div class="col-xl-4">
                    <div class="card widget widget-list">
                        <div class="card-header">
                            <h5 class="card-title">{{ $plan->plan_name }}<span class="badge badge-info badge-style-light">FIXED PRICE</span></h5>
                        </div>
                        <div class="card-body">
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
                                    <span class="widget-list-item-transaction-amount-positive">{{ $plan->duration }} days</span>
                                </li>                                    
                                <li class="widget-list-item widget-list-item-blue">
                                    <span class="widget-list-item-description">
                                        <span class="widget-list-item-description-title">
                                            Daily Earnings:
                                        </span>
                                    </span>
                                    <span class="widget-list-item-transaction-amount-positive">{{ $plan->daily_earnings }}%</span>
                                </li>                                    
                                <li>
                                    <div class="row">
                                        <div class="col-6">
                                            <form action="{{ route('investment-plans.destroy', ['investment_plan' => $plan->id]) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <input type="submit" value="Delete" class="btn btn-danger">
                                            </form>
                                        </div>
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
                                <h3>There are currently no plans, click "Create New Plan" above to create one.</h3>
                            </div>
                        </div>
                        <div class="text-center">
                        </div>
                    </div>
                </div>
                @endforelse
        </div>
            {{-- LIST OF PLANS ENDS HERE --}}
        </div>
    </div>
</div>
@endsection