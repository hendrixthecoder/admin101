@extends('admin.layouts.index')

@section('title', "$title - Manage Users")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Users</h1>
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
                <div class="table-responsive">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th scope="col">ID</th>
                                <th scope="col">Username</th>
                                <th scope="col">First Name</th>
                                <th scope="col">Country</th>
                                <th scope="col">Email</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Inv. Plan</th>
                                <th scope="col">Can Withdraw</th>
                                <th scope="col">Status</th>
                                <th scope="col">Date registered</th>
                                <th scope="col" colspan="2" class="text-center">Actions</th>
                            </tr>
                        </thead>
                        @forelse ($users as $user)
                        <tbody>
                            <tr>
                                <th scope="row">{{ $user->id }}</th>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->f_name }}</td>
                                <td>{{ $user->country }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->p_number }}</td>
                                <td>Plan</td>
                                <td>{{ $user->can_withdraw ? "Yes" : "No" }}</td>
                                <td>{{ $user->status }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $user->id }}">
                                        Actions
                                    </button>
                                
                                <!-- Modal -->
                                    <div class="modal fade" id="exampleModal{{ $user->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog modal-xl modal-dialog-centered modal-dialog-scrollable">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Actions</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body d-flex column">
                                                    <form id="delete_form" action="{{ route('user.update', ['user' => $user->id]) }}" method="post" style="">
                                                        @csrf
                                                        @method('DELETE')
                                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                                        <input type="submit" value="Delete" class="btn btn-danger">
                                                    </form>

                                                    <a href="{{ route('adminEditUserForm', ['user' => $user->id]) }}" class="btn btn-primary">Edit</a>

                                                    <a href="{{ route('creditUserForm', ['id' => $user->id]) }}" class="btn btn-success">Credit User</a>

                                                    <a href="{{ route('debitUserForm', ['id' => $user->id]) }}" class="btn btn-danger">Debit User</a>

                                                    <form id="lock_form" action="{{ route('adminLockUser', ['id' => $user->id]) }}" method="post" style="">
                                                        @csrf
                                                        <input type="submit" value="Lock User" class="btn btn-danger">
                                                    </form>

                                                    <form id="unlock_form" action="{{ route('adminUnlockUser', ['id' => $user->id]) }}" method="post" style="">
                                                        @csrf
                                                        <input type="submit" value="Unlock User" class="btn btn-success">
                                                    </form>

                                                    <a href="{{ route('adminEmailUser', ['id' => $user->id]) }}" class="btn btn-success">Email User</a>

                                                    <a href="{{ route('adminGetUserReferrals', ['id' => $user->id]) }}" class="btn btn-success">Get User Referrals</a>

                                                    <form action="{{ route('adminToggleUserWithdrawal', ['id' => $user->id]) }}" method="post">
                                                        @csrf
                                                        <input type="submit" value="{{ $user->can_withdraw ? "Stop Withdrawal" : "Allow Withdrawal" }}" class="btn btn-{{ $user->can_withdraw ? "danger" : "success" }}">
                                                    </form>


                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
            </div>
        </div>
    </div>
</div>
@endsection