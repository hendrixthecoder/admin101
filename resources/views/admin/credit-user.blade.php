@extends('admin.layouts.index')

@section('title', "$title - Credit User")
@section('content')
<div class="app-content">
    <div class="content-wrapper">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-description">
                        <h1>Credit {{ $user->username }}</h1>
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
                <div class="col-xl-12">
                    <div class="card">
                        <div class="card-body">
                            <form class="row g-3" action="{{ route('creditUser', ['id' => $user->id]) }}" method="POST">
                                @csrf
                                <div class="col-md-4">
                                    <label for="inputState" class="form-label">Where to credit</label>
                                    <select id="inputState" name="whereToCredit" class="form-select">
                                        {{-- <option selected value="balance">Balance</option> --}}
                                        <option value="profit">Profit</option>
                                        <option value="bonus">Bonus</option>
                                    </select>
                                </div>
                                <div class="col-xl-8">
                                    <label for="inputZip" class="form-label">Amount</label>
                                    <input type="text" name="amount" class="form-control" id="inputZip">
                                </div>
                                <div class="col-12">
                                    <input type="submit" value="Submit" class="btn btn-primary">
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection