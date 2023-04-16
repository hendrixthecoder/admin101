@extends('user.layouts.index')
@section('title', "$title - Support")
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
                        <h1>{{ env('APP_NAME') }} @lang('messages.support')</h1>
                    </div>
                    <div class="page-description">
                        <h4>@lang('messages.supportMessage') {{ env('MAIL_FROM_ADDRESS') }}</h4>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection