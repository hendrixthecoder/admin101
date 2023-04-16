<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Deposits;
use App\Models\Wdmethods;
use App\Models\Withdrawal;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\InvestmentPlans;
use App\Models\PaymentDetails;
use App\Models\Settings;

class AdminPageController extends Controller
{
    public function dashboard () {

        $title = env('APP_NAME');
        $planCount = InvestmentPlans::count();
        $userNotAdminCount = User::where('is_admin', false)->get()->count();

        //Count of deposits and sum of total deposits
        $totalDeposits = Deposits::sum('amount');
        $totalDepositsCount = Deposits::count();

        //Count of withdrawals and sum of total withdrawals
        $totalWithdrawal = Withdrawal::sum('amount');
        $totalWithdrawalCount = Withdrawal::count();

        //Total deposits and withdrawals amount
        $pendingDeposits = Deposits::where('status', 'Pending')->sum('amount');
        $pendingWithdrawals = Withdrawal::where('status', 'Pending')->sum('amount');

        //COUNT OF DEPOSITS AND WIHDRAWALS
        $pendingWithdrawalsCount = Withdrawal::where('status', 'Pending')->count();
        $pendingDepositsCount = Deposits::where('status', 'Pending')->count();

        $blockedUsers = User::where('can_withdraw', false)->count();

        return view('admin.dashboard', compact(['title','blockedUsers', 'planCount', 'userNotAdminCount', 'totalDeposits', 'pendingDepositsCount',
                                                'pendingDeposits', 'totalWithdrawal', 'pendingWithdrawals', 'pendingWithdrawalsCount',
                                                'totalDepositsCount', 'totalWithdrawalCount']));
    }

    public function siteSettingsPage () {
        $title = env('APP_NAME');
        $wdmethods = Wdmethods::all();
        $paymentDetails = PaymentDetails::all();
        $bankDetail = PaymentDetails::find(1);
        $btcDetail  = PaymentDetails::find(2);
        $ethDetail = PaymentDetails::find(3);

        $siteSettings = Settings::find(1);

        return view('admin.site-settings', compact('siteSettings','title', 'wdmethods', 'paymentDetails', 'ethDetail', 'btcDetail', 'bankDetail'));
    }

    public function manageUsers () {
        $title = env('APP_NAME');
        $user = new User();
        $users = $user->getFiltered()->paginate(5);

        return view('admin.manageusers', compact(['users', 'title']));
    }

    public function addUserForm () {
        $title = env('APP_NAME');

        return view('admin.adduser', compact(['title']));
    }

    public function manageDeposits () {
        $title = env('APP_NAME');
        $transactions = Deposits::paginate(10);

        return view('admin.managedeposits', compact(['transactions', 'title']));
    }

    public function manageWithdrawals () {
        $title = env('APP_NAME');
        $transactions = Withdrawal::all();
        
        return view('admin.manageWithdrawals', compact(['transactions', 'title']));
    }

    public function editProfile (Request $request) {
        $title = env('APP_NAME');
        $user = $request->user();

        return view('admin.profile-settings', compact(['user', 'title']));
    }

    public function creditUser ($id) {
        $title = env('APP_NAME');
        $user = User::findOrFail($id);
        return view('admin.credit-user', compact(['title', 'user']));
    }

    public function debitUSer ($id) {
        $title = env('APP_NAME');
        $user = User::findOrFail($id);

        return view('admin.debit-user', compact(['title', 'user']));
    }

    public function manageKyc () {
        $title = env('APP_NAME');
        $users = User::where('kyc_status', 'Submitted')->paginate(10);

        return view('admin.manage-kyc', compact(['users','title']));
    }

}
