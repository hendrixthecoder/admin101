<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateUser;
use App\Models\InvestmentPlans;

class UsersController extends Controller
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
        
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
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

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user, Request $request)
    {
        $title = env('APP_NAME');
        
        return view('user.settings', ['user' => $user, 'title' => $title ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(User $user, Request $request)
    {
        //USER MAKING THE REQUEST TO UPDATE THEIR PROFILE


        $user = $request->user();

        //USER USERNAME
        if(empty($request->username)){
            //DO NOTHING
        }else{
            $user->username = $request->username;
        }

        //USER FIRST_NAME
        if(empty($request->f_name)){
            //DO NOTHING
        }else{
            $user->f_name = $request->f_name;
        }

        //USER LAST_NAME
        if(empty($request->l_name)){
            //DO NOTHING
        }else{
            $user->l_name = $request->l_name;
        }

        //BANK ACCOUNT NAME
        if(empty($request->bank_acct_name)){

        }else{
            $user->bank_acct_name = $request->bank_acct_name;
        }

        //BANK NAME
        if(empty($request->bank_name)){

        }else{
            $user->bank_name = $request->bank_name;
        }
        //BANK ACCOUNT NUMBER
        if(empty($request->bank_acct_no)){

        }else{
            $user->bank_acct_no = $request->bank_acct_no;
        }

        //USER BTC ADDRESS
        if(empty($request->btc_address)){

        }else{
            $user->btc_address = $request->btc_address;
        }

        //USER ETH ADDRESS
        if(empty($request->eth_address)){

        }else{
            $user->ethereum_address = $request->eth_address;
        }

        //USER PHONE NUMBER
        if(empty($request->p_number)){
            //DO NOTHING
        }else{
            $user->p_number = $request->p_number;
        }

        //USER EMAIL
        if(empty($request->email)){
            //DO NOTHING
        }else{
            $user->email = $request->email;
        }

        if(empty($request->usdt_address)){
            //DO NOTHING
        }else{
            $user->usdt_address = $request->usdt_address;
        }

        if(empty($request->p_money)){
            //DO NOTHING
        }else{
            $user->p_money = $request->p_money;
        }

        $user->can_withdraw = $user->can_withdraw;

        $user->save();

        return back()->with('message', trans('auth.profileUpdSuc'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        if($request->user()->hasRole('admin')){
            $user = User::findOrFail($id);
            $user->delete();

            return back()->with('message', 'User has been deleted successfully!');
        }else{
            abort(403, 'Access denied as you aren\'t an admin!');
        }

    }
    
}
