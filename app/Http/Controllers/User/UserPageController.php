<?php

namespace App\Http\Controllers\User;

use App\Models\User;
use App\Models\Settings;
use App\Events\NewROISent;
use Illuminate\Http\Request;
use App\Models\PaymentDetails;
use App\Models\InvestmentPlans;
use Illuminate\Support\Facades\App;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class UserPageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function home (Request $request) {

        $title = env('APP_NAME');
        
        if($request->user()->hasRole('admin')){
            return redirect()->route('adminDashboard');

        }else{

            $user = $request->user();

            $plansCount = $user->investmentPlans()->count();
            $deposits = $user->deposits()->sum('amount');
            $depositsCount = $user->deposits()->count();
            $referralBonus = $user->getBonusCredits() - $user->getReversedBonus();
            $profit = $user->getDueProfit() - $user->getReversedProfit();
            $balance = $user->getBalance(); 
            
            // aloha

            return view('user.index', compact(['profit','user', 'deposits', 'balance', 'title', 'plansCount', 'depositsCount', 'referralBonus']));
        }


    }

    public function investplans (Request $request) {
        $title = env('APP_NAME');
        $user = $request->user();
        $plans = InvestmentPlans::all();
        $balance = $user->getBalance();

        return view('user.investplans', compact(['plans', 'title', 'user', 'balance']));
    }

    public function acctinfo (Request $request) {
        $title = env('APP_NAME');
        $user = $request->user();

        return view('user.accountdetails', compact(['user','title']));
    }

    public function support () {
        $title = env('APP_NAME');
        return view('user.support', compact('title'));
    }

    public function deposits (Request $request) {
        $title = env('APP_NAME');
        $user = $request->user();

        $deposits = $user->deposits()->paginate(2);
        
        //GET USER BALANCE
        $balance = $user->getBalance();

        return view('user.deposits', compact(['balance', 'deposits', 'title']));
    }

    public function withdrawals (Request $request) {
        $title = env('APP_NAME');
        $user = $request->user();
        $siteSettings = Settings::find(1);

        $transactions = $user->withdrawals()->orderBy('id', 'desc')->paginate(10);

        //GET USER BALANCE

        $balance = $user->getBalance();

        return view('user.withdrawals', compact(['siteSettings','transactions', 'balance', 'title']));
    }

    public function myplans (Request $request) {

        $title = env('APP_NAME');
        $user = $request->user();
        $plans = $user->investmentPlans;

        return view('user.my-plans', compact(['plans', 'title']));
    }

    public function accthist (Request $request) {
        $title = env('APP_NAME');

        $transactions = $request->user()->transactions()->where('source', 'Admin Top Up')
                        ->orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'top-up'
        );

        $bonus = $request->user()->transactions()->where('whereToCredit','Bonus')->orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'bonus'
        );

        $roi = $request->user()->transactions()->where('whereToCredit', 'Profit')->orderBy('id', 'desc')->where('pay_day','<=',now())->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'roi'
        );

        $capitalReturns = $request->user()->transactions()->where('source', 'Capital')->where('end_day', '<', now())->orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'capital-returns'
        );

        $reversals = $request->user()->transactions()->where('source', 'Reversal')->orWhere('source', 'Profit Reversal')->orWhere('source', 'Bonus Reversal')->orderBy('id', 'desc')->paginate(
            $perPage = 10, $columns = ['*'], $pageName = 'reversals'
        );

        return view('user.accounthistory', compact(['capitalReturns','reversals','transactions', 'roi', 'title', 'bonus']));
    }

    public function refer (Request $request) {
        $title = env('APP_NAME');
        $user = $request->user();
        $referrals = User::where('referred_by', $user->referral_key)->get();

        $refereeData = User::where('referral_key', $user->referred_by)->first();

        $referee = '';

        if($refereeData){
            $referee = 'You were referred by "'.$refereeData->username.'".';
        }

        return view('user.referuser', compact(['title', 'user', 'referrals', 'referee']));
    }

    public function makePayment (Request $request) {
        
        $title = env('APP_NAME');
        $amount = $request->amount;
        $paymentDetails = PaymentDetails::where('status', 1)->get();

        if(is_null($amount)){
            return redirect()->route('deposits');
        }

        return view('user.payment', compact('amount', 'title', 'paymentDetails'));
    }

}





