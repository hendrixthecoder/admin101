@extends('admin.layouts.index')

@section('title', "$title - Manage Deposits")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Manage Deposits</h1>
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
            <div class="card mt-5">
                <div class="card-header">
                  Hi there admin!
                </div>
                <div class="card-body">
                  <blockquote class="blockquote mb-0">
                    <p>There are currenty no deposits!</p>
                    <footer class="blockquote-footer">Have a great <cite title="Source Title">day!</cite></footer>
                  </blockquote>
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
                                    <th scope="col">Source</th>
                                    <th scope="col">Date created</th>
                                    <th scope="col">Proof</th>
                                    <th scope="col" colspan="2" class="text-center">Actions</th>
                                </tr>
                            </thead>
                            @forelse ($transactions as $transaction)
                            <tbody>
                                <tr>
                                    <th scope="row">{{ $transaction->id }}</th>
                                    <td>{{ $transaction->user->username }}</td>
                                    <td>{{ $transaction->user->f_name }}</td>
                                    <td>{{ $transaction->user->email }}</td>
                                    <td>${{ $transaction->amount }}</td>
                                    <td>{{ $transaction->status }}</td>
                                    <td>{{ $transaction->source }}</td>
                                    <td>{{ $transaction->created_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $transaction->id }}">
                                        View
                                        </button>
                                    </td>
                                    <div class="row">
                                        <div class="col">
                                            <!-- Button trigger modal -->
                                            
                        
                                            <!-- Modal -->
                                            <div class="modal fade" id="exampleModal{{ $transaction->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="exampleModalLabel">View proof of payment</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <img src="{{ env('APP_URL') }}cloud/uploads/proof/{{ $transaction->proof_path }}" alt="" style="max-width: 100%; height:auto;">
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @if ($transaction->status == 'Pending')
                                        <td>
                                            <form id="approve_form" action="{{ route('approveDeposit', ['id' => $transaction->id]) }}" method="post" style="">
                                                @csrf
                                                <input type="submit" value="Process" class="btn btn-success">
                                            </form>
                                        </td>
                                        <td>
                                            <form id="delete_form" action="{{ route('declineDeposit', ['id' => $transaction->id]) }}" method="post" style="">
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
                                </tr>
                            </tbody>
                            @empty
                            <div class="card widget widget-stats">
                                <div class="card-body">
                                    <div class="widget-tweet-container">
                                        <div class="widget-tweet-content">
                                            <h3>There are currently no deposits, click "New Deposit" above to create one.</h3>
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
                                {{ $transactions->links() }}
                            </div>
                        </div>
                    </div>
                </div>
            @endif
    </div>
</div>
@endsection

{{-- when a user signs up a token is generated for them thats saved in the referal key column of the users table --}}
{{-- when a user clicks on a url that has a token field the controller checks the datbase if any exists and if it doesnt it will return an error saying no such key but will take the user to the sign in page --}}
{{-- however if the token is correct the user will be sent to the register page with a success saying the username of the user they were referred by --}}