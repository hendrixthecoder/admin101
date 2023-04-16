@extends('user.layouts.index')
@section('title', "$title - Transaction History")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="page-description page-description-tabbed">
                        <h1 id="">@lang('messages.transactionHistory')</h1>

                        <ul class="nav nav-tabs mb-3" id="myTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="account-tab" data-bs-toggle="tab" data-bs-target="#account" type="button" role="tab" aria-controls="hoaccountme" aria-selected="true">Admin Top-Up</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="security-tab" data-bs-toggle="tab" data-bs-target="#security" type="button" role="tab" aria-controls="security" aria-selected="false">ROI</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="integrations-tab" data-bs-toggle="tab" data-bs-target="#integrations" type="button" role="tab" aria-controls="integrations" aria-selected="false">Referral Bonus</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#return" type="button" role="tab" aria-controls="return" aria-selected="false">Capital Return</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="return-tab" data-bs-toggle="tab" data-bs-target="#reversal" type="button" role="tab" aria-controls="reversal" aria-selected="false">Reversal</button>
                            </li>
                        </ul>
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
            <div class="row">
                <div class="col">
                    @if (session()->has('message'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Success!</span>
                                <span class="alert-text">{{ session()->get('message') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
                            <div class="card">
                                <div class="card-body">
                                    @if ($transactions->isEmpty())
                                        No records exists.
                                    @else
                                    <div class="row">
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Type</th>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Message</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($transactions as $transaction)
                                                    <tr>
                                                        <th scope="row">{{ $transaction->id }}</th>
                                                        <td>${{ $transaction->amount }}</td>
                                                        <td>{{ $transaction->type }}</td>
                                                        <td>{{ $transaction->status }}</td>
                                                        <td>{{ $transaction->source }} </td>
                                                        <td>{{ $transaction->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
                            <div class="card">
                                <div class="card-body">
                                    @if ($roi->isEmpty())
                                        You have no ROI yet! Join a plan to start earning.
                                    @else
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Message</th>
                                                    <th scope="col">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($roi as $eachRoi) 
                                                <tr>
                                                    <th scope="row">{{ $eachRoi->id }}</th>
                                                    <td>${{ $eachRoi->amount }}</td>
                                                    <td>{{ $eachRoi->source }}</td>
                                                    <td>{{ $eachRoi->pay_day }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                        <div class="row">
                                            <div class="col">
                                                {{ $roi->links() }}
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="integrations" role="tabpanel" aria-labelledby="integrations-tab">
                            <div class="card">
                                <div class="card-body">
                                    @if ($bonus->isEmpty())
                                        You have made no referrals so you have no referrals as of yet, make referrals and receive your bonus here.
                                    @else
                                    @foreach ($bonus as $eachBonus)
                                    <div class="table-responsive">
                                        <table class="table table-striped table-bordered">
                                            <thead>
                                                <tr>
                                                    <th scope="col">ID</th>
                                                    <th scope="col">Amount</th>
                                                    <th scope="col">Message</th>
                                                    <th scope="col">Date</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                            @foreach ($bonus as $transaction) 
                                                <tr>
                                                    <th scope="row">{{ $transaction->id }}</th>
                                                    <td>${{ $transaction->amount }}</td>
                                                    <td>{{ $transaction->source }}</td>
                                                    <td>{{ $transaction->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        </table>
                                    </div>
                                    @endforeach
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="return" role="tabpanel" aria-labelledby="security-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-body">
                                        @if ($capitalReturns->isEmpty())
                                            No record exists.
                                        @else
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($capitalReturns as $capitalReturn) 
                                                    <tr>
                                                        <th scope="row">{{ $capitalReturn->id }}</th>
                                                        <td>${{ $capitalReturn->amount }}</td>
                                                        <td>{{ $capitalReturn->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="reversal" role="tabpanel" aria-labelledby="security-tab">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-body">
                                        @if ($reversals->isEmpty())
                                            No record exists.
                                        @else
                                        <div class="table-responsive">
                                            <table class="table table-striped table-bordered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">ID</th>
                                                        <th scope="col">Amount</th>
                                                        <th scope="col">Message</th>
                                                        <th scope="col">Date</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($reversals as $reversal) 
                                                    <tr>
                                                        <th scope="row">{{ $reversal->id }}</th>
                                                        <td>${{ $reversal->amount }}</td>
                                                        <td>{{ $reversal->source }}</td>
                                                        <td>{{ $reversal->created_at }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                            </table>
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
</div>
@endsection