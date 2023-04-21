@extends('admin.layouts.index')

@section('title', "$title - Manage KYC")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage User KYC Uploads</h1>
                    </div>
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
            </div>
            <div class="row">
                <div class="col">
                    @if (session()->has('success'))
                        <div class="alert alert-custom alert-indicator-top indicator-success mt-3" role="alert">
                            <div class="alert-content">
                                <span class="alert-title">Success!</span>
                                <span class="alert-text">{{ session()->get('success') }}</span>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row">
                @if ($users->isEmpty())
                    <div class="col">
                        <div class="card">
                            <div class="card-body">
                                <div class="widget-tweet-container">
                                    <div class="widget-tweet-content">
                                        <h3>There are currently no KYC uploads, try again later.</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @else
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">Username</th>
                                    <th scope="col">First Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Phone</th>
                                    <th scope="col" class="text-center">Documents</th>
                                    <th scope="col" class="">Approve</th>
                                    <th scope="col" class="">Decline</th>
                                </tr>
                            </thead>
                            @forelse ($users as $user)
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $user->id }}</th>
                                    <td>{{ $user->username }}</td>
                                    <td>{{ $user->f_name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>{{ $user->p_number }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}">
                                            View
                                        </button>
                                    
                                    <!-- Modal -->
                                        <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Documents</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body d-flex column">
                                                        <img src="{{ env('APP_URL') }}cloud/uploads/kyc/{{ $user->id_path }}" alt="" style="max-width: 100%; height:auto; margin-right:20px">
                                                        <img src="{{ env('APP_URL') }}cloud/uploads/kyc/{{ $user->photo_path }}" alt="" style="max-width: 100%; height:auto;">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('approveKyc') }}" method="post" id="approve_form">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button class="btn btn-primary" onclick="document.getElementById('approve_form').submit();">Approve</button>
                                        </form>
                                    </td>
                                    <td>
                                        <form action="{{ route('declineKyc') }}" method="post" id="decline_form">
                                            @csrf
                                            <input type="hidden" name="user_id" value="{{ $user->id }}">
                                            <button class="btn btn-danger" onclick="document.getElementById('approve_form').submit();">Decline</button>
                                        </form>
                                    </td>
                            </tbody>
                            @empty
                            <div class="card widget widget-stats">
                                <div class="card-body">
                                    <div class="widget-tweet-container">
                                        <div class="widget-tweet-content">
                                            <h3>There are currently no users, try again after there are users.</h3>
                                        </div>
                                    </div>
                                    <div class="text-center">
                                    </div>
                                </div>
                            </div>
                            @endforelse
                        </table>
                        <div class="row">
                            <div class="col">
                                {{ $users->links() }}
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection