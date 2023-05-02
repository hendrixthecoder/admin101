<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreUserRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Monarobase\CountryList\CountryListFacade;

class RegisterController extends Controller
{
    public function showRegisterForm () {
        $title = env('APP_NAME');
        $countries = CountryListFacade::getList('en');
        return view('auth.register', compact(['title', 'countries']));
    }

    public function storeUser (StoreUserRequest $request) {
        // This route is used by both admin and users, so i used Auth::check to confirmed if the user is authenticated which, if true, would show that they are an admin
        if(!Auth::check()){
            $user = new User();
            $user->username = $request->input('username');
            $user->email = $request->input('email');
            $user->p_number = $request->p_number;
            $user->f_name = $request->f_name;
            $user->l_name = $request->l_name;
            $user->password = Hash::make($request->input('password'));
            $user->is_admin = false;
            $user->can_withdraw = true;
            $user->kyc_status = 'Unverified';
            $user->country = $request->country;

            if($request->referred_by){
                $user->referred_by = $request->referred_by;
            }else{
                if($request->referral_id){
                    $referee = User::where('referral_key', $request->referral_id)->first();
                    if($referee){
                        $user->referred_by = $request->referral_id;
                    }
                }
            }
            
            function generateKey(){
                $key = mt_rand(100,9000);

                if(checkIfKeyExists($key)){
                    return generateKey();
                }

                return $key;
            }
            
            function checkIfKeyExists($key){
                return User::where('referral_key', $key)->first();
            }

            generateKey();

            $user->referral_key = generateKey();

            $user->status = 'Active';
            $user->save();
    
            Auth::login($user);
            $user->attachRole('user');

            return redirect()->route('home')->with('user', $user);
            
        }else{
            if($request->user()->hasRole('admin')){
                $user = new User();

                $user->username = $request->input('username');
                $user->email = $request->input('email');
                $user->p_number = $request->p_number;
                $user->f_name = $request->f_name;
                $user->l_name = $request->l_name;
                $user->password = Hash::make($request->input('password'));
                $user->is_admin = false;
                $user->can_withdraw = true;
                $user->kyc_status = 'Unverified';
                $user->country = $request->country;

                function generateKey(){
                    $key = mt_rand(100,9000);
    
                    if(checkIfKeyExists($key)){
                        return generateKey();
                    }
    
                    return $key;
                }
                
                function checkIfKeyExists($key){
                    return User::where('referral_key', $key)->first();
                }
    
                generateKey();
    
                $user->referral_key = generateKey();
                $user->status = 'Active';
                $user->save();

                return back()->with('message', 'User created successfully!');
    
            };
        };
    
    }
}
