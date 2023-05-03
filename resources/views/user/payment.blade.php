@extends('user.layouts.index')
@section("title", "$title - Make Payment")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container-fluid">
            @if (session()->has('message'))
            <div class="text-center alert alert-success">
                {{ session()->get('message') }}
            </div>
            @endif
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>@lang('messages.makePayment')</h1>
                        <span>@lang('messages.makePaymentPrompt')</span><span><b>${{ $amount }}</b></span>
                    </div>
                </div>
            </div>
            <div class="accordion" id="accordionIconsExample">
                @forelse ($paymentDetails as $paymentDetail)
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="icons-headingOne">
                            <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#icons-collapseOne{{ $paymentDetail->id }}" aria-expanded="false" aria-controls="icons-collapseOne">
                                <i class="material-icons-two-tone">monetization_on</i>{{ $paymentDetail->name }}
                            </button>
                        </h2>
                        <div id="icons-collapseOne{{ $paymentDetail->id }}" class="accordion-collapse collapse" aria-labelledby="icons-headingOne" data-bs-parent="#accordionIconsExample">
                            <div class="accordion-body">
                                <div class="col-md-6">
                                    @if ($paymentDetail->name == 'BTC')
                                        <span>@lang('messages.bitcoinAddress') : {{ $paymentDetail->address }}</span>
                                        <img src="{{ $paymentDetail->path }}" alt="BTC QR CODE" style="max-width: 100%; margin-top:5px" height="auto">
                                        <input type="hidden" id="btc_address" name="" value="{{ $paymentDetail->path }}">
                                        <div class="mt-3">
                                            <span>Click here to copy wallet address</span>
                                            <button class="btn btn-primary" type="button" id="share-link1"><i class="material-icons no-m fs-5">content_copy</i></button>
                                        </div>

                                    @elseif ($paymentDetail->name == 'USDT(Trc20)')
                                        <span>@lang('messages.usdtAddress') : {{ $paymentDetail->address }}</span>
                                        <img src="{{ $paymentDetail->path }}" alt="USDT QR CODE" style="max-width: 100%; margin-top:5px" height="auto">
                                        <input type="hidden" id="usdt_address" name="" value="{{ $paymentDetail->path }}">
                                        <div class="mt-3">
                                            <span>Click here to copy wallet address</span>
                                            <button class="btn btn-primary" type="button" id="share-link2"><i class="material-icons no-m fs-5">content_copy</i></button>
                                        </div>

                                    @elseif ($paymentDetail->name == 'ETH')
                                    <span>@lang('messages.ethereumAddress') : {{ $paymentDetail->address }}</span>
                                    <img src="{{ $paymentDetail->path }}" alt="ETH QR CODE" style="max-width: 100%; margin-top:5px" height="auto">
                                    <input type="hidden" id="eth_address" name="" value="{{ $paymentDetail->path }}">
                                    <div class="mt-3">
                                        <span>Click here to copy wallet address</span>
                                        <button class="btn btn-primary" type="button" id="share-link3"><i class="material-icons no-m fs-5">content_copy</i></button>
                                    </div>
                                    
                                    @else
                                        <span>@lang('messages.perfectMoney') : {{ $paymentDetail->address }}</span>
                                    @endif
                                </div>
                                <div class="col-md-6">
                                    <span>{{ $paymentDetail->eth_address ?  __('messages.ethereumAddress').": ". $paymentDetail->eth_address : "" }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    
                @endforelse
            </div>
            @if ($paymentDetails->isEmpty())
                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body text-center">
                                <p>@lang('messages.noActivePaymentMethod')</p>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <div class="row">
                    <div class="col">
                        <form action="{{ route('deposits.store') }}"  method="post" enctype="multipart/form-data">
                            @csrf
                            <label for="source" class="mt-4 mb-2">@lang('messages.paymentSource'):</label>
                            <select class="js-states form-control" id="source" name="source" tabindex="-1" style="width: 100%">
                                <optgroup label="Payment Mode">
                                    @foreach ($paymentDetails as $paymentDetail)
                                        <option value="{{ $paymentDetail->name }}">{{ $paymentDetail->name }}</option>   
                                    @endforeach
                                </optgroup>
                            </select>
                            <label for="proof" class="mt-4 mb-2">@lang('messages.paymentProof'):</label>
                            <input type="file" name="proof" id="proof" class="form-control" required>
                            <input type="hidden" name="amount" value="{{ $amount }}">
                            <input type="submit" value="@lang('messages.submit')" class="mt-3 btn btn-primary">
                        </form>
                    </div>
                </div>
            @endif
        </div>
    </div>
</div>
<script>
    $('#share-link1').click(function(){
    "use strict";
        var copyText = document.getElementById("btc_address");
        copyText.select();
        copyText.setSelectionRange(0, 99999);
        /*For mobile devices*/
        document.execCommand("copy");
        
        alert('BTC Address Copid!');
  });
</script>
@endsection