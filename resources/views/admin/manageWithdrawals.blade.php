@extends('admin.layouts.index')

@section('title', "$title - Manage Deposits")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Withdrawals</h1>
                    </div>
                </div>
            </div>
                <div class="row">
                    <div class="col">
                        @if (session()->has('status'))
                            <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                                <div class="alert-content">
                                    <span class="alert-title">Success!</span>
                                    <span class="alert-text">{{ session()->get('status') }}</span>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            @if ($transactions->isEmpty())
                <div class="card widget widget-stats">
                    <div class="card-body">
                        <div class="widget-tweet-container">
                            <div class="widget-tweet-content">
                                <h3>There are currently no transactions, when a user has placed a withdrawal come back here.</h3>
                            </div>
                        </div>
                        <div class="text-center">
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Client Email</th>
                                    <th scope="col">Amount</th>
                                    <th scope="col">Status</th>
                                    <th scope="col">Date created</th>
                                    <th scope="col">Payment Details</th>
                                    <th scope="col">Payment Method</th>
                                    <th scope="col" colspan="2" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            @foreach ($transactions as $transaction)
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $transaction->id }}</th>
                                    <td>{{ $transaction->user->username }}</td>
                                    <td>{{ $transaction->user->f_name }}</td>
                                    <td>{{ $transaction->user->email }}</td>
                                    <td>${{ $transaction->amount }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>{{ $transaction->receive_details }}</td>
                                    <td>{{ $transaction->receive_method }}</td>
                                    @if ($transaction->status == 'Pending')
                                        <td>
                                            <form id="approve_form" action="{{ route('approveWithdrawal', ['id' => $transaction->id]) }}" method="post" style="">
                                                @csrf
                                                <input type="submit" value="Process" class="btn btn-success">
                                            </form>
                                        </td>
                                        <td>
                                            <form id="delete_form" action="{{ route('declineWithdrawal', ['id' => $transaction->id]) }}" method="post" style="">
                                                @csrf
                                                <input type="submit" value="Decline" class="btn btn-danger">
                                            </form>
                                        </td>
                                    @elseif ($transaction->status == 'Processed')
                                        <td colspan="2" class="align-items-center">
                                            <button disabled="disabled" class="btn btn-primary">Processed</button>
                                        </td>
                                    @elseif ($transaction->status == 'Declined')
                                        <td colspan="2" class="align-items-center">
                                            <button disabled="disabled" class="btn btn-danger">Declined</button>
                                        </td>
                                    @endif  
                            </tbody>
                            @endforeach
                        </table>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
@endsection