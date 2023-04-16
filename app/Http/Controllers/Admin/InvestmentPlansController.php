<?php

namespace App\Http\Controllers\Admin;

use App\Models\InvestmentPlans;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreInvestmentPlansRequest;
use App\Http\Requests\UpdateInvestmentPlansRequest;

class InvestmentPlansController extends Controller
{

    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(InvestmentPlans $investmentPlans)
    {
        $this->authorize('viewAny', $investmentPlans);
        $title = env('APP_NAME');
        return view('admin.investplans', ['title' => $title, 'plans' => InvestmentPlans::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(InvestmentPlans $investmentPlans)
    {
        $this->authorize('create', $investmentPlans);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreInvestmentPlansRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreInvestmentPlansRequest $request, InvestmentPlans $investmentPlans)
    {
        $validated = $request->validated();
        $investmentPlans = InvestmentPlans::create($validated);
        return back()->with('message', 'Hurrah! Investment plan created successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InvestmentPlans  $investmentPlans
     * @return \Illuminate\Http\Response
     */
    public function show(InvestmentPlans $investmentPlans)
    {
        $this->authorize('view', $investmentPlans);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InvestmentPlans  $investmentPlans
     * @return \Illuminate\Http\Response
     */
    public function edit(InvestmentPlans $investmentPlans)
    {
        $this->authorize('update', $investmentPlans);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateInvestmentPlansRequest  $request
     * @param  \App\Models\InvestmentPlans  $investmentPlans
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvestmentPlansRequest $request, InvestmentPlans $investmentPlans)
    {
        $this->authorize('update', $investmentPlans);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InvestmentPlans  $investmentPlans
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, InvestmentPlans $investmentPlans)
    {
        $this->authorize('delete', $investmentPlans);
        $investmentPlans = InvestmentPlans::findOrFail($id);
        $investmentPlans->delete();

        return back()->with('message', 'Plan has been deleted successfully!');
    }
}
