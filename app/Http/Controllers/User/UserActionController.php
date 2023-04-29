<?php

namespace App\Http\Controllers\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Settings;
use App\Models\UserPlan;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\InvestmentPlans;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Monarobase\CountryList\CountryListFacade;

class UserActionController extends Controller
{

    public function joinPlan (Request $request, $id) {

        $validated = $request->validate([
            'amount' => 'bail|required|'
        ]);
        
        $amount = $validated['amount'];
        $settings = Settings::find(1);
        $balance = $request->user()->getBalance();
        $plan = InvestmentPlans::findOrFail($id);

        if($balance < $plan->min_deposit || $amount > $plan->max_deposit || $amount < $plan->min_deposit) {
            return back()->with('error', trans('auth.planError'));
        }

        if($request->user()->referred_by){
            $referee1 = User::where('referral_key', $request->user()->referred_by)->first();

            $newReferralBonus = new Transaction();
            $newReferralBonus->user_id = $referee1->id;
            $newReferralBonus->name = $referee1->username;
            $newReferralBonus->email = $referee1->email;
            $newReferralBonus->type = 'Credit';
            $newReferralBonus->amount = ($settings->referral_bonus_first * $amount)/100;
            $newReferralBonus->source = '1st Level Referral Bonus';
            $newReferralBonus->status = 'Processed';
            $newReferralBonus->whereToCredit = 'Bonus';
            $newReferralBonus->pay_day = now();
            $newReferralBonus->end_day = now()->addDay();
            $newReferralBonus->save();

            if($referee1->referred_by){
                $referee2 = User::where('referral_key', $referee1->referred_by)->first();

                $newReferralBonus = new Transaction();
                $newReferralBonus->user_id = $referee2->id;
                $newReferralBonus->name = $referee2->username;
                $newReferralBonus->email = $referee2->email;
                $newReferralBonus->type = 'Credit';
                $newReferralBonus->amount = ($settings->referral_bonus_second * $amount)/100;
                $newReferralBonus->source = '2nd Level Referral Bonus';
                $newReferralBonus->status = 'Processed';
                $newReferralBonus->whereToCredit = 'Bonus';
                $newReferralBonus->pay_day = now();
                $newReferralBonus->end_day = now()->addDay();
                $newReferralBonus->save();

                if($referee2->referred_by){
                    $referee3 = User::where('referral_key', $referee2->referred_by)->first();

                    $newReferralBonus = new Transaction();
                    $newReferralBonus->user_id = $referee3->id;
                    $newReferralBonus->name = $referee3->username;
                    $newReferralBonus->email = $referee3->email;
                    $newReferralBonus->type = 'Credit';
                    $newReferralBonus->amount = ($settings->referral_bonus_third * $amount)/100;
                    $newReferralBonus->source = '3rd Level Referral Bonus';
                    $newReferralBonus->status = 'Processed';
                    $newReferralBonus->whereToCredit = 'Bonus';
                    $newReferralBonus->pay_day = now();
                    $newReferralBonus->end_day = now()->addDay();
                    $newReferralBonus->save();
                }
            }
        }

        for($i = 1; $i <= $plan->duration; $i++){
            $profit = new Transaction();
            $profit->name = $request->user()->username;
            $profit->email = $request->user()->email;
            $profit->type = 'Credit';
            $profit->source = 'ROI';
            $profit->amount = ($amount * $plan->daily_earnings) / 100;
            $profit->status = 'Processed';
            $profit->pay_day = now()->addDays($i);
            $profit->whereToCredit = 'Profit';
            $profit->user_id = $request->user()->id;
            $profit->end_day = now()->addDays($plan->duration);
            $profit->save();
        }

        $balanceBack = new Transaction();
        $balanceBack->name = $request->user()->username;
        $balanceBack->email = $request->user()->email;
        $balanceBack->type = 'Credit';
        $balanceBack->amount = $amount;
        $balanceBack->source = 'Capital';
        $balanceBack->status = 'Processed';
        $balanceBack->pay_day = now();
        $balanceBack->end_day = now()->addDays($plan->duration);
        $balanceBack->whereToCredit = 'Balance';
        $balanceBack->user_id = $request->user()->id;
        $balanceBack->save();

        $pay_day = now()->addDays($plan->duration);

        $user_plan = new UserPlan();
        $user_plan->user_id = $request->user()->id;
        $user_plan->amount = $amount;
        $user_plan->pay_day = $pay_day;
        $user_plan->plan_id = $plan->id;
        $user_plan->plan_name = $plan->plan_name;
        $user_plan->plan_profit = (($amount * $plan->daily_earnings) / 100) * $plan->duration;
        $user_plan->save();

        $request->user()->investmentPlans()->attach($plan->id, ['amount' => $amount, 'pay_day' => $pay_day]);

        return back()->with('success', trans('messages.planJoinSucc'));

    }

    public function referralHandling ($key) {
        $title = env('APP_NAME');
        $countries = CountryListFacade::getList('en');
        $user = User::where('referral_key', $key)->first();

        if($user){
            return view('auth.register', compact(['title','key', 'countries']));
        }

        return view('auth.no-refer', compact(['title', 'countries']));
    }

    public function changePassword (Request $request) {

        $validated = $request->validate([
            'oldPassword' => 'bail|required',
            'password' => 'bail|required|min:8|alpha_num|confirmed',
            'password_confirmation' => 'bail|required',

        ]);

        $user = $request->user();

        if(Hash::check($validated['oldPassword'], $user->password)){
            $user->password = Hash::make($validated['password']);
            $user->save();

            return back()->with('successTrans', trans('auth.passChangeSuc'));
        }

        return back()->with('error', trans('auth.errPass'));

    }

    public function setKyc (Request $request) {
        $validated = $request->validate([
            'idcard' => 'bail|required|mimes:jpg,png,jpeg|max:10240',
            'photo' => 'bail|required|mimes:jpg,png,jpeg|max:10240'
        ]);

        $upload_dir = "../cloud/uploads/kyc";

        $idcard_path = Carbon::now()->timestamp.'.'.$validated['idcard']->getClientOriginalExtension();
        $validated['idcard']->move($upload_dir, $idcard_path);

        $photo_path = Carbon::now()->addSeconds(3)->timestamp.'.'.$validated['photo']->getClientOriginalExtension();;
        $validated['photo']->move($upload_dir, $photo_path);

        $user = $request->user();
        $user->id_path = $idcard_path;
        $user->photo_path = $photo_path;
        $user->kyc_status = 'Submitted';

        $user->save();

        return back()->with('success', trans('auth.kycUplSuc'));
    }

}
