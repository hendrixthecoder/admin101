<?php

namespace App\Http\Controllers\User;

use App\Models\Withdrawal;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Settings;
use NumberFormatter;

class WithdrawalController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = $request->user();
        $siteSettings = Settings::find(1);

        if($siteSettings->allow_withdrawals){

            if($user->can_withdraw){

                if($lastWithdrawal = $user->withdrawals->last()){
    
                    if(is_null($user->withdrawals()->where('status', 'Pending')->first())){
                        // If a withdrawal has been placed and is pending it will refuse the user from making another.
    
                        if((now()->diffInHours($lastWithdrawal->created_at) >= 24)) {

                            if($request->amount >= $siteSettings->minimum_withdrawal){
                                
                                if($request->withdrawal_source == 'Profit'){
                                    $balance = $user->getDeductableProfit();

                                }

                                $balance = $user->getBonusBalance();

                
                                if($request->amount >= $balance){
                                    return back()->with('error', trans('auth.insufficientFunds'));
                                }
                
                                $withdrawal = new Withdrawal();
                
                                if($request->receive_method == 'Bank Transfer'){
                                    if(is_null($user->bank_acct_name) || is_null($user->bank_acct_no) || is_null($user->bank_name)){
                                        return redirect()->route('acctinfo')->with('error', 'You will need to update
                                            your bank account info to be able to place a wihdrawal into your bank.');
                                    }else{
                                        $withdrawal->receive_details = $user->bank_acct_name.' '.$user->bank_acct_no.' '.$user->bank_name;
                                    }
                                }
                
                                if($request->receive_method == 'Bitcoin'){
                                    if(is_null($user->btc_address)){
                                        return redirect()->route('acctinfo')->with('error', 'You will need to add
                                            a bitcoin address to be able to place a withdrawal into your bitcoin address.');
                                    }else{
        
                                        $withdrawal->receive_details = $user->btc_address;
                                    }
                                }
                
                                if($request->receive_method == 'Ethereum'){
                                    if(is_null($user->ethereum_address)){
                                        return redirect()->route('acctinfo')->with('error', 'You will need to add
                                            an ethereum address to be able to place a withdrawal into your ethereum address.');
                                    }else{
                                    
                                        $withdrawal->receive_details = $user->ethereum_address;
                                    }
                                }
                
                                $withdrawal->user_id = $user->id;
                                $withdrawal->name = $user->username;
                                $withdrawal->amount = $request->amount;
                                $withdrawal->source = $request->withdrawal_source;
                                $withdrawal->type = 'Debit';
                                $withdrawal->email = $user->email;
                                $withdrawal->status = 'Pending';

                                function generateTransactionId() {
                                    $id = substr(md5(rand()),0,25);
                        
                                    if(checkId($id)){
                                        return generateTransactionId();
                                    }
                        
                                    return $id;
                                }
                        
                                function checkId($id) {
                                    return Withdrawal::where('transaction_id', $id)->first();
                                }
                        
                                $withdrawal->transaction_id = generateTransactionId();
                                $withdrawal->receive_method = $request->receive_method;
                                $withdrawal->save();
                
                                return back()->with('success', trans('auth.sucWitd'));
                                
                            }

                            return back()->with('error', trans('auth.minWitd').$siteSettings->minimum_withdrawal.'.');
                        }
                    }
    
                    return back()->with('error', trans('auth.witdTwentyFour'));
                
                }


                    // If it returns null because there are no transactions in the past 24 meaning they can withdraw
                    if($request->amount >= $siteSettings->minimum_withdrawal){

                        if($request->withdrawal_source == 'profit'){
                            $balance = $user->getDeductableProfit();

                        }

                        $balance = $user->getBonusBalance();
        
                        if($request->amount >= $balance){
                            return back()->with('error', trans('auth.insufficientFunds'));
                        }
    
                        $withdrawal = new Withdrawal();
        
                        if($request->receive_method == 'Bank Transfer'){
                            if(is_null($user->bank_acct_name) || is_null($user->bank_acct_no) || is_null($user->bank_name)){
                                return redirect()->route('acctinfo')->with('error', 'You will need to update
                                    your bank account info to be able to place a wihdrawal into your bank.');
                            }else{
        
        
                                $withdrawal->receive_details = $user->bank_acct_name.' '.$user->bank_acct_no.' '.$user->bank_name;
                            }
                        }
        
                        if($request->receive_method == 'Bitcoin'){
                            if(is_null($user->btc_address)){
                                return redirect()->route('acctinfo')->with('error', 'You will need to add
                                    a bitcoin address to be able to place a withdrawal into your bitcoin address.');
                            }else{
        
                                $withdrawal->receive_details = $user->btc_address;
                            }
                        }
        
                        if($request->receive_method == 'Ethereum'){
                            if(is_null($user->ethereum_address)){
                                return redirect()->route('acctinfo')->with('error', 'You will need to add
                                    an ethereum address to be able to place a withdrawal into your ethereum address.');
                            }else{
                            
        
                                $withdrawal->receive_details = $user->ethereum_address;
                            }
                        }

                        if($request->receive_method == 'USDT'){
                            if(is_null($user->usdt_address)){
                                return redirect()->route('acctinfo')->with('error', 'You will need to add
                                    an USDT address to be able to place a withdrawal into your USDT address.');
                            }else{
                            
        
                                $withdrawal->receive_details = $user->ethereum_address;
                            }
                        }

                        if($request->receive_method == 'Perfect Money'){
                            if(is_null($user->p_money)){
                                return redirect()->route('acctinfo')->with('error', 'You will need to add
                                    an Perfect Money address to be able to place a withdrawal into your Perfect Money wallet.');
                            }else{
                            
                                $withdrawal->receive_details = $user->ethereum_address;
                            }
                        }
        
        
                        $withdrawal->user_id = $user->id;
                        $withdrawal->name = $user->username;
                        $withdrawal->amount = $request->amount;
                        $withdrawal->source = $request->withdrawal_source;
                        $withdrawal->type = 'Debit';
                        $withdrawal->email = $user->email;
                        $withdrawal->status = 'Pending';

                        function generateTransactionId() {
                            $id = substr(md5(rand()),0,25);
                
                            if(checkId($id)){
                                return generateTransactionId();
                            }
                
                            return $id;
                        }
                
                        function checkId($id) {
                            return Withdrawal::where('transaction_id', $id)->first();
                        }
                
                        $withdrawal->transaction_id = generateTransactionId();
                        $withdrawal->receive_method = $request->receive_method;
                        $withdrawal->save();
        
                        return back()->with('success', trans('auth.sucWitd'));
                    }

                    return back()->with('error', trans('auth.minWitd').$siteSettings->minimum_withdrawal.'.');
                
            }     
    
            return back()->with('error', trans('auth.accOnHold'));
        }

        return back()->with('error', trans('auth.sysNoWitd'));

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function show(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function edit(Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Withdrawal $withdrawal)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Withdrawal  $withdrawal
     * @return \Illuminate\Http\Response
     */
    public function destroy(Withdrawal $withdrawal)
    {
        //
    }
}
