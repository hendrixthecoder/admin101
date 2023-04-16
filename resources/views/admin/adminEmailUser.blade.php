@extends('admin.layouts.index')

@section('title', "$title - Email $user->username")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
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
                    <div class="page-description">
                        <h1>Email {{ $user->username }}</h1>
                    </div>
                </div>
            </div>
            <div class="card">
                <div class="card-body">
                    <div class="settings-security-two-factor">
                        <h5>Hello there {{ Auth::user()->username }}!</h5>
                        <span>To send an email to "{{ $user->username }}", click the button below!</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="composeModal" tabindex="-1" aria-labelledby="composeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="composeModalLabel">Compose Email</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="emailUser" method="POST" action="{{ route('postAdminEmailUser', ['id' => $user->id]) }}">
                            @csrf
                            <label for="composeEmailTo" class="form-label">Email address</label>
                            <input type="email" class="form-control m-b-sm" id="composeEmailTo" aria-describedby="emailHelp" disabled value="{{ $user->email }}">

                            <label for="composeEmailToName" class="form-label">Full Name</label>
                            <input type="name" class="form-control m-b-sm" id="composeEmailToName" aria-describedby="emailHelpName" disabled value="{{ $user->f_name }} {{ $user->l_name }}">

                            <label for="subject" class="form-label">Subject</label>
                            <input type="text" name="subject" class="form-control m-b-sm" id="subject">

                            <label for="composeTitle" class="form-label">Message</label>
                            <textarea name="email" id="composeTitle" cols="30" rows="10" aria-describedby="title" class="form-control m-b-lg"></textarea>
                            <div id="compose-editor"></div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" onclick="document.getElementById('emailUser').submit();" class="btn btn-success">Send</button>
                    </div>
                </div>
            </div>
        </div>
        <button type="button" class="btn btn-primary btn-burger mailbox-compose-btn" data-bs-toggle="modal" data-bs-target="#composeModal"><i class="material-icons-outlined">create</i></button> 
    </div>
</div>
@endsection