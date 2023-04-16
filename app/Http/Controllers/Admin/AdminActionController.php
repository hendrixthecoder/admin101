<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminActionController extends Controller
{
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
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $title = env('APP_NAME');
        $username = $user->username;
        return view('admin.edituserform', ['title' => $title, 'user' => $user, 'username' => $username]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //ADMIN UPDATING USER
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
            if(empty($request->state)){
                //DO NOTHING
            }else{
                $user->state = $request->state;
            }
            if(empty($request->about)){
                //DO NOTHING
            }else{
                $user->about = $request->about;
            }
            if(empty($request->news_letter)){
                //DO NOTHING
            }else{
                $user->news_letter = $request->news_letter;
            }
            if(empty($request->session_logout)){
                //DO NOTHING
            }else{
                $user->session_logout = $request->session_logout;
            }
    
            $user->save();
    
            return back()->with('message', 'Profile Updated successfully!');
        }else{
            abort(403, 'Action Unauthorized');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }

    
}


