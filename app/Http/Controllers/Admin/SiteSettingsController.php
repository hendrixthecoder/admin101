<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PaymentDetails;
use App\Models\Settings;
use Illuminate\Http\Request;

class SiteSettingsController extends Controller
{
    public function editPaymentDetails (Request $request) {
        // $bankDetail = PaymentDetails::find(1);
        // $btcDetail = PaymentDetails::find(2);
        // $ethDetail = PaymentDetails::find(3);

        // if($request->bank_name) {
        //     $bankDetail->bank_name = $request->bank_name;
        // }

        // if($request->bank_account_name){
        //     $bankDetail->bank_account_name = $request->bank_account_name;
        // }

        // if($request->bank_account_number){
        //     $bankDetail->bank_account_number = $request->bank_account_number;
        // }

        // if($request->btc_address){
        //     $btcDetail->btc_address = $request->btc_address;
        // }

        // if($request->eth_address){
        //     $ethDetail->eth_address = $request->eth_address;
        // }

        // $bankDetail->save();
        // $btcDetail->save();
        // $ethDetail->save();
        return back()->with('success', 'Payment details edited successfully!');
    }

    public function editPaymentStatus (Request $request) {
        $btc = PaymentDetails::find(1);
        $usdt = PaymentDetails::find(2);
        $eth = PaymentDetails::find(3);
        $pmoney = PaymentDetails::find(4);

        if($request->btc){
            $btc->status = 1;
        }else{
            $btc->status = 0;
        }

        if($request->usdt){
            $usdt->status = 1;
        }else{
            $usdt->status = 0;
        }

        if($request->eth){
            $eth->status = 1;
        }else{
            $eth->status = 0;
        }
        
        if($request->pmoney) {
            $pmoney->status = 1;
        }else{
            $pmoney->status = 0;
        }

        $btc->save();
        $usdt->save();
        $eth->save();
        $pmoney->save();

        return back()->with('success', 'Payment Mode edited successfully!');

    }

    public function editPreferences (Request $request) {
        $validated = $request->validate([
            'minimum_withdrawal' => 'numeric',
            'referral_bonus_first' => 'numeric',
            'referral_bonus_second' => 'numeric',
            'referral_bonus_third' =>'numeric'
        ]);

        $settings = Settings::find(1);

        $settings->minimum_withdrawal = $validated['minimum_withdrawal'];
        $settings->referral_bonus_first = $validated['referral_bonus_first'];
        $settings->referral_bonus_second = $validated['referral_bonus_second'];
        $settings->referral_bonus_third = $validated['referral_bonus_third'];

        $settings->save();

        return back()->with('success', 'Site settings updated successfully!');
    }

    public function allowWithdrawals (Request $request) {
        $settings = Settings::find(1);
        if($settings->allow_withdrawals == "0"){
            $settings->allow_withdrawals = 1;
        }else{
            $settings->allow_withdrawals = 0;
        }

        $settings->save();

        return back()->with('success', 'Action successful!');
    }
}
