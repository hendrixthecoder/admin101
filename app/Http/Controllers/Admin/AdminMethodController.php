<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Deposits;
use App\Models\Withdrawal;
use App\Models\Transaction;
use App\Mail\AdminEmailUser;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Mail\ApproveKycMail;
use App\Mail\DeclineKycMail;
use App\Mail\NotifyUserOnSucDeposit;
use Illuminate\Support\Facades\Mail;
use App\Mail\NotifyUserOnSucWithdrawal;
use Illuminate\Support\Facades\Storage;

class AdminMethodController extends Controller
{

    public function creditUser (Request $request, $id) {

        $user = User::findOrFail($id);
        $newCredit = new Transaction();
        $newCredit->name = $user->username;
        $newCredit->email = $user->email;
        $newCredit->type = "Credit";
        $newCredit->user_id = $user->id;
        $newCredit->amount = $request->amount;
        $newCredit->source = 'Admin Top Up';
        $newCredit->status = 'Processed';
        $newCredit->pay_day = now();
        $newCredit->end_day = now();

        if($request->whereToCredit == 'balance'){
            $newCredit->whereToCredit = 'Balance';

        }elseif($request->whereToCredit == 'profit'){
            $newCredit->whereToCredit = 'Profit';
            $newCredit->source = 'ROI';
            $newCredit->pay_day = now()->subMinutes(1);
            
        }else{
            $newCredit->source = 'Bonus';
            $newCredit->whereToCredit = 'Bonus';
        }

        $newCredit->save();   

        return back()->with('success', 'User has been credited successfully!');

    }

    public function debitUser (Request $request, $id) {

        $user = User::findOrFail($id);
        $newDebit = new Transaction();

        $newDebit->user_id = $user->id;
        $newDebit->name = $user->username;
        $newDebit->email = $user->email;
        $newDebit->type = 'Debit';
        $newDebit->amount = $request->amount;
        $newDebit->status = 'Processed';
        $newDebit->pay_day = now();
        $newDebit->end_day = now();

        if($request->whereToDebit == 'balance'){
            $newDebit->whereToDebit = 'Balance';
            $newDebit->source = 'Reversal';

        }elseif($request->whereToDebit == 'profit'){
            $newDebit->whereToDebit = 'Profit';
            $newDebit->source = 'Profit Reversal';

        }elseif($request->whereToDebit == 'bonus'){
            $newDebit->source = 'Bonus Reversal';
            $newDebit->whereToDebit = 'Bonus';
        }

        $newDebit->save();

        return back()->with('success', 'User has been debited successfully!');
    }


    public function approveDeposit($id) {
        $deposit = Deposits::findOrFail($id);
        $deposit->status = 'Processed';
        $deposit->save();

        $amount = $deposit->amount;
        $user = $deposit->user;
        $transaction_id = $deposit->transaction_id;
        Mail::to($user)->send(new NotifyUserOnSucDeposit($user, $transaction_id, $amount));

        return back()->with('status', 'Deposit has been approved successfully!');
    }

    public function declineDeposit($id) {
        $deposit = Deposits::findOrFail($id);
        $deposit->status = 'Declined';
        $deposit->save();

        return back()->with('status', 'Deposit has been declined successfully!');
    }

    public function approveWithdrawal($id) {
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->status = 'Processed';
        $withdrawal->save();
        
        $amount = $withdrawal->amount;
        $user = $withdrawal->user;
        $transaction_id = $withdrawal->transaction_id;

        Mail::to($user)->send(new NotifyUserOnSucWithdrawal($user, $transaction_id, $amount));

        return back()->with('status', 'Withdrawal has been approved successfully!');
    }

    public function declineWithdrawal ($id){
        $withdrawal = Withdrawal::findOrFail($id);
        $withdrawal->status = 'Declined';
        $withdrawal->save();

        return back()->with('status', 'Withdrawal has been declined successfully!');
    }

    public function editProfile(Request $request) {
        $user = User::find($request->user()->id);
        if($request->user()->hasRole('admin')){
            if(empty($request->username)){
                //DO NOTHING
            }else{
                $user->username = $request->username;
            }
            if(empty($request->f_name)){
                //DO NOTHING
            }else{
                $user->f_name = $request->f_name;
            }
            if(empty($request->l_name)){
                //DO NOTHING
            }else{
                $user->l_name = $request->l_name;
            }
            if(empty($request->p_number)){
                //DO NOTHING
            }else{
                $user->p_number = $request->p_number;
            }
            if(empty($request->email)){
                //DO NOTHING
            }else{
                $user->email = $request->email;
            }

    
            $user->save();
    
            return back()->with('message', 'Profile Updated successfully!');
        }else{
            abort(403, 'Action Unauthorized');
        }
    }

    public function lockUser ($id) {
        $user = User::findOrFail($id);
        $user->status = 'Locked';

        $user->save();

        return back()->with('message', 'User locked successfully');
    }

    public function unlockUser ($id) {
        $user = User::findOrFail($id);
        $user->status = 'Unlocked';
        $user->save();

        return back()->with('message', 'User unlocked succcessfully');
    }

    public function emailUser ($id) {
        $title = env('APP_NAME');
        $user = User::findOrFail($id);
        return view('admin.adminEmailUser', compact(['user','title']));
    }

    public function postEmailUser (Request $request, $id){
        $user = User::findOrFail($id);
        $subject = $request->subject;
        Mail::to($user)->send(new AdminEmailUser($user, $request->email, $subject));

        return back()->with('message', 'Email sent successfully!');
    }

    public function getUserReferrals($id){
        $user = User::findOrFail($id);
        $title = env('APP_NAME');

        $referrals = User::where('referred_by', $user->referral_key)->get();

        return view('admin.get-user-referrals', compact(['user', 'title', 'referrals']));
    }

    public function approveKyc (Request $request) {
        $user = User::findOrFail($request->user_id);

        unlink('../cloud/uploads/kyc/'.$user->id_path);
        unlink('../cloud/uploads/kyc/'.$user->photo_path);

        $user->id_path = '';
        $user->photo_path = '';
        $user->kyc_status = 'Verified';
        $user->save();

        Mail::to($user)->send(new ApproveKycMail($user));

        return back()->with('success', 'Action successful');
    }
    
    public function declineKyc (Request $request) {
        $user = User::findOrFail($request->user_id);

        unlink('../cloud/uploads/kyc/'.$user->id_path);
        unlink('../cloud/uploads/kyc/'.$user->photo_path);

        $user->id_path = '';
        $user->photo_path = '';
        $user->kyc_status = 'Failed';
        $user->save();

        Mail::to($user)->send(new DeclineKycMail($user));

        return back()->with('success', 'Action successful');

    }

    
}
