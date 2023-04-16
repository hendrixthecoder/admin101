@extends('auth.layout')

@section('title', "$title - Create account")
@section('content')

<div class="enclosing">
    <div class="row">
        <div class="">
            <h1 class="mb-4">{{ env('APP_NAME') }}</h1>
        </div>
    </div>
    <div class="row space">
        <div class="card mt-5">
            <div class="card-header">
                Oh dear!
            </div>
            <div class="card-body">
                <blockquote class="blockquote mb-0">
                <p>Looks like you have used an incorrect URL, no user in our community has that referral link. Please check that you have provided the correct URL, you can always register without a referral by clicking this <a href="{{ route('showRegisterForm') }}">link</a></p>
                <footer class="blockquote-footer">Have a great <cite title="Source Title">day!</cite></footer>
                </blockquote>
            </div>
        </div>
    </div>
</div>
@endsection