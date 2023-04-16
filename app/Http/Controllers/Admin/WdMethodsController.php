<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWdmethodsRequest;
use App\Models\Wdmethods;
use Illuminate\Http\Request;

class WdMethodsController extends Controller
{
    public function addWithdrawalMethod (Request $request) {
        dd($request->all());
        $validated = $request->validated();
        Wdmethods::create($validated);

        return back()->with('success', 'Withdrawal method created successfully!');
        
    }
}
