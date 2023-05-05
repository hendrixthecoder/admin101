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
                    <div class="page-description page-description-tabbed">
                        <h1 id="">@lang('messages.myInvestmentPlans')</h1>

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#community" type="button" role="tab" aria-controls="community" aria-selected="true">Community Bot🤖</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#personal" type="button" role="tab" aria-controls="personal" aria-selected="false">Personal Bot Pro🤖</button>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="community" role="tabpanel" aria-labelledby="community-tab">
                            <div class="card">
                                <div class="card-body">
                                    @if ($community_plans->isEmpty())
                                        You have not purchased Community Bot🤖 yet! Join a plan to start earning.
                                    @else
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Days Left</th>
                                                    <th scope="col">Date Bought</th>
                                                    <th scope="col">Profit Expected</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($community_plans as $community_plan) 
                                                <tr>
                                                    <th scope="row">{{ $community_plan->id }}</th>
                                                    <td>${{ $community_plan->amount }}</td>
                                                    <td>{{ $community_plan->days_left }}</td>
                                                    <td>{{ $community_plan->created_at }}</td>
                                                    <td>${{ $community_plan->plan_profit }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col">
                                                {{ $community_plans->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="personal" role="tabpanel" aria-labelledby="personal-tab">
                            <div class="card">
                                <div class="card-body">
                                    @if ($personal_plans->isEmpty())
                                        You have not purchased Personal Bot Pro🤖! Join a plan to start earning.
                                    @else
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Days Left</th>
                                                        <th scope="col">Date Bought</th>
                                                        <th scope="col">Profit Expected</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($personal_plans as $personal_plan) 
                                                    <tr>
                                                        <th scope="row">{{ $personal_plan->id }}</th>
                                                        <td>${{ $personal_plan->amount }}</td>
                                                        <td>{{ $personal_plan->days_left }}</td>
                                                        <td>{{ $personal_plan->created_at }}</td>
                                                        <td>${{ $personal_plan->plan_profit }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                            <div class="row">
                                                <div class="col">
                                                    {{ $personal_plans->links() }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
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