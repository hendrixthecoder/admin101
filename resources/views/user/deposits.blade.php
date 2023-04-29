@extends('user.layouts.index')
@section('title', "$title - Your Deposits")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>@lang('messages.deposits')</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if (session()->has('message'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">@lang('messages.success')</span>
                                <span class="alert-text">{{ session()->get('message') }}</span>
                            </div>
                        </div>
                        @endif
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
                    <!-- Button trigger modal -->
                    <button type="button" class="btn btn-primary mb-4 mt-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                        <i class="material-icons-two-tone">add</i>@lang('messages.newDeposits')
                    </button>

                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">@lang('messages.makeNewDeposit')</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form class="row g-3" action="{{ route('makePayment') }}" method="POST">
                                        @csrf
                                        <div class="col-12">
                                            <label for="inputAddress" class="form-label">@lang('messages.amount')</label>
                                            <input type="text" name="amount" class="form-control" id="inputAddress" placeholder="">
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
            <div class="row">
                @if ($deposits->isEmpty())
                <div class="col">
                    <div class="card mt-5">
                        <div class="card-header">
                          @lang('messages.whoops')
                        </div>
                        <div class="card-body">
                          <blockquote class="blockquote mb-0">
                            <p>@lang('messages.noDeposits')</p>
                            <footer class="blockquote-footer">@lang('messages.greatDay')</footer>
                          </blockquote>
                        </div>
                    </div>
                </div>
                @else
                <div class="col">
                    <div class="card">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered">
                                    <thead>
                                        <tr>
                                            <th scope="col">ID</th>
                                            <th scope="col">@lang('messages.amount')</th>
                                            <th scope="col">Payment Mode</th>
                                            <th scope="col">Date Created</th>
                                            <th scope="col">Status</th>
                                            <th scope="col">Transaction ID</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($deposits as $deposit)
                                            <tr>
                                                <th scope="row">{{ $deposit->id }}</th>
                                                <td>${{ $deposit->amount }}</td>
                                                <td>{{ $deposit->source }}</td>
                                                <td>{{ $deposit->created_at }}</td>
                                                <td>{{ $deposit->status }}</td>
                                                <td>{{ $deposit->transaction_id }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="row">
                                    <div class="col">
                                        {{ $deposits->links() }}
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
                          @lang('messages.balance')
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
            <div class="row">
                <div class="col">
                    <div class="card">
                        <div class="card-body text-center">
                            <p>@lang('messages.depositPageMessage')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection