<?php

namespace App\Http\Controllers;

use App\Models\Deposits;
use App\Models\Transaction;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreDeposits;
use Image;

class DepositsController extends Controller
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
    public function store(StoreDeposits $request)
    {
        $newDeposit = new Deposits();
        $newDeposit->user_id = $request->user()->id;
        $newDeposit->amount = $request->amount;
        $newDeposit->source = $request->source;
        $newDeposit->status = 'Pending';

        function generateTransactionId() {
            $id = substr(md5(rand()),0,25);

            if(checkId($id)){
                return generateTransactionId();
            }

            return $id;
        }

        function checkId($id) {
            return Deposits::where('transaction_id', $id)->first();
        }

        $newDeposit->transaction_id = generateTransactionId();

        $img = $request->proof->store('/uploads/proof', 'public');

        $newDeposit->proof_path = env('APP_URL').'/'.$img;
        $newDeposit->save();

        return redirect()->route('deposits')->with('message', trans('auth.depSuc'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Deposits  $deposits
     * @return \Illuminate\Http\Response
     */
    public function show(Deposits $deposits)
    {
        //gtgtgt_
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Deposits  $deposits
     * @return \Illuminate\Http\Response
     */
    public function edit(Deposits $deposits)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Deposits  $deposits
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Deposits $deposits)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Deposits  $deposits
     * @return \Illuminate\Http\Response
     */
    public function destroy(Deposits $deposits)
    {
        //
    }
}
