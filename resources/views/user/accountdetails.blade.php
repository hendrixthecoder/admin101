@extends('user.layouts.index')

@section('title', "$title - Edit Withdrawal Info")
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
            <div class="container my-5">
                <h1>@lang('messages.addWithdrawalInfo')</h1>
            </div>
            <div class="accordion" id="accordionIconsExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="icons-headingOne">
                        <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#icons-collapseOne" aria-expanded="true" aria-controls="icons-collapseOne">
                            <i class="material-icons-two-tone">lightbulb</i>@lang('messages.bankTransfer')
                        </button>
                    </h2>
                    <div id="icons-collapseOne" class="accordion-collapse collapse" aria-labelledby="icons-headingOne" data-bs-parent="#accordionIconsExample">
                        <div class="accordion-body">
                            <form class="row g-3" action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">@lang('messages.bankName')</label>
                                    <input type="text" name="bank_name" class="form-control" id="inputAddress" placeholder="" value="{{ $user->bank_name }}">
                                </div>
                                <div class="col-12">
                                    <label for="inputAddress2" class="form-label">@lang('messages.bankAccountName')</label>
                                    <input type="text" name="bank_acct_name" class="form-control" id="inputAddress2" placeholder="" value="{{ $user->bank_acct_name }}">
                                </div>
                                <div class="col-md-6">
                                    <label for="inputCity" class="form-label">@lang('messages.bankAccountNumber')</label>
                                    <input type="text" name="bank_acct_no" class="form-control" id="inputCity" placeholder="" value="{{ $user->bank_acct_no }}">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="fliconsush-headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#icons-collapseTwo" aria-expanded="false" aria-controls="icons-collapseTwo">
                            <i class="material-icons-two-tone">savings</i>@lang('messages.bitcoin')
                        </button>
                    </h2>
                    <div id="icons-collapseTwo" class="accordion-collapse collapse" aria-labelledby="icons-headingTwo" data-bs-parent="#accordionIconsExample">
                        <div class="accordion-body">
                            <form class="row g-3" action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">@lang('messages.bitcoinAddress')</label>
                                    <input type="text" name="btc_address" class="form-control" id="inputAddress" placeholder="" value="{{ $user->btc_address }}">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="accordion-item">
                    <h2 class="accordion-header" id="icons-headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#icons-collapseThree" aria-expanded="false" aria-controls="icons-collapseThree">
                            <i class="material-icons-two-tone">extension</i>@lang('messages.ethereum')
                        </button>
                    </h2>
                    <div id="icons-collapseThree" class="accordion-collapse collapse" aria-labelledby="icons-headingThree" data-bs-parent="#accordionIconsExample">
                        <div class="accordion-body">
                            <form class="row g-3" action="{{ route('user.update', ['user' => $user->id]) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="col-12">
                                    <label for="inputAddress" class="form-label">@lang('messages.ethereumAddress')</label>
                                    <input type="text" name="eth_address" class="form-control" id="inputAddress" placeholder="" value="{{ $user->ethereum_address }}">
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">@lang('messages.submit')</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>    
    </div>
</div>

    
@endsection