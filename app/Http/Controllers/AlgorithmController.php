<?php

namespace App\Http\Controllers;

use App\Models\Algorithm;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AlgorithmController extends Controller
{
    public function __construct() {
        $this->middleware('isAdmin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $algo = Algorithm::orderBy('active', 'ASC')->get();
        return response()->json($algo, 200);
    }

    public function algoJSON()
    {
        $algo = Algorithm::where('active', '=', 'Y')->get();
        return $algo;
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
        $request->validate([
            'text' => ['nullable','string'],
            'actionType' => ['string','nullable'],
            'positive' => ['nullable','string'],
            'negative' => ['nullable','string'],
            'onPositive' => ['nullable','numeric'],
            'onNegative' => ['nullable','numeric'],
            'nextMove' => ['nullable','numeric'],
            'tempPlan' => ['nullable','string'],
            'delay' => ['required','numeric'],
            'series' => ['nullable','numeric'],
            'active' => ['nullable','string'],
            'conditionalFactor' => ['nullable','string'],
            'conditionalOperator' => ['nullable','string'],
            'conditionalValue' => ['nullable','string'],
            'stateValue' => ['nullable','string'], 
            'label' => ['nullable','string'],
            'progestogenPossible' => ['nullable','string'],
        ]);
        
        $algo = Algorithm::create($request->all());
        if($algo){
            return response()->json('Done', 201);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Algorithm  $algorithm
     * @return \Illuminate\Http\Response
     */
    public function show(Algorithm $algorithm)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Algorithm  $algorithm
     * @return \Illuminate\Http\Response
     */
    public function edit(Algorithm $algorithm)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Algorithm  $algorithm
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $algo = Algorithm::findOrFail($id);
        $res = $algo->update($request->only('text', 'actionType', 'positive', 'negative', 'onPositive',
                                            'onNegative', 'nextMove', 'tempPlan', 'delay', 'series', 'active',
                                            'conditionalFactor', 'conditionalOperator', 'conditionalValue','stateValue', 'label', 'progestogenPossible', 'progestogenPossibleDir', 'tempPlanDirN', 'tempPlanDirP'));
        if($res){
            return response()->json($algo, 200);
        } else {
            return response()->json('null', 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Algorithm  $algorithm
     * @return \Illuminate\Http\Response
     */
    public function destroy(Algorithm $algorithm)
    {
        //
    }
}
