@extends('admin.layouts.index')

@section('title', "$title - Show $user->username's Referrals")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Get {{ $user->username }}'s referrals</h1>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col">
                    @if ($referrals->isEmpty())
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-3">This user has no referrals.</h5>
                            </div>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title"></h5>
                            </div>
                            <div class="card-body">
                                <p class="card-description"></p>
                                <div class="table-responsive">
                                    <table class="table table-bordered">
                                        <thead class="table-dark">
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Username</th>
                                                <th scope="col">Full Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Date Referred</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($referrals as $referral)                                            
                                                <tr>
                                                    <th scope="row">{{ $referral->id }}</th>
                                                    <td>{{ $referral->username }}</td>
                                                    <td>{{ $referral->f_name }} {{ $referral->l_name }}</td>
                                                    <td>{{ $referral->email }}</td>
                                                    <td>{{ $referral->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        </div>
    </div>
</div>
@endsection