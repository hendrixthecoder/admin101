@extends('user.layouts.index')
@section('title', "$title - Your Withdrawals")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>@lang('messages.withdrawals')</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if (session()->has('error'))
                        <div class="alert alert-custom alert-indicator-top indicator-danger mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">@lang('messages.whoops')</span>
                                <span class="alert-text">{{ session()->get('error') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            </div>
            <div class="row">
                <div class="col">
                    @if (session()->has('success'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">@lang('messages.success')</span>
                                <span class="alert-text">{{ session()->get('success') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="material-icons-two-tone">add</i>@lang('messages.newWithdrawals')
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('messages.makeNewWithdrawal')</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" action="{{ route('withdrawals.store') }}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">@lang('messages.amount')</label>
                                            <input type="text" name="amount" class="form-control" id="inputAddress" placeholder="">
                                        </div>
                                        <div class="col-12">
                                            <label for="inputPaymentType" class="form-label">@lang('messages.howToReceivePayment')</label>
                                            <select id="inputState" name="receive_method" class="form-select">
                                                <option value="Bitcoin">@lang('messages.bitcoin')</option>
                                                <option value="Bank Transfer">@lang('messages.bankTransfer')</option>
                                                <option value="Ethereum">@lang('messages.ethereum')</option>
                                                <option value="USDT">USDT(TRC20)</option>
                                                <option value="Perfect Money">Perfect Money</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <label for="inputPaymentType" class="form-label">Withdrawal Source</label>
                                            <select required id="inputState" name="withdrawal_source" class="form-select">
                                                <option value="Profit">Profit - (${{ $balance }})</option>
                                                <option value="Bonus">Referral Bonus - (${{ $bonus }})</option>
                                            </select>
                                        </div>
                                        <div class="col-12">
                                            <input type="submit" class="btn btn-primary" value="@lang('messages.submit')">
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if ($transactions->isEmpty())
            <div class="row">
                <div class="col">
                    <div class="card mt-5">
                        <div class="card-header">
                        @lang('messages.whoops')
                        </div>
                        <div class="card-body">
                        <blockquote class="blockquote mb-0">
                            <p>@lang('messages.noWithdrawals')</p>
                            <footer class="blockquote-footer">@lang('messages.greatDay')</cite></footer>
                        </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            @else
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">Amount</th>
                                            <th scope="col">Source</th>
                                            <th scope="col">Payment Mode</th>
                                            <th scope="col">Payment Details</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Transaction Id</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($transactions as $transaction)
                                            <tr>
                                                <th scope="row">{{ $transaction->id }}</th>
                                                <td>${{ $transaction->amount }}</td>
                                                <td>{{ $transaction->source }}</td>
                                                <td>{{ $transaction->receive_method }}</td>
                                                <td>{{ $transaction->receive_details }}</td>
                                                <td>{{ $transaction->created_at }}</td>
                                                <td>{{ $transaction->status }}</td>
                                                <td>{{ $transaction->transaction_id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col">
                                        {{ $transactions->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="card mt-5">
                        <div class="card-header">
                          @lang('messages.profits')
                        </div>
                        <div class="card-body">
                          <blockquote class="blockquote mb-0">
                            <p>${{ $balance }}</p>
                            <footer class="blockquote-footer">@lang('messages.greatDay')</cite></footer>
                          </blockquote>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <p>@lang('messages.withdrawalPageMessage')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection