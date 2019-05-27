<?php

namespace App\Http\Controllers\V1\General;

use Illuminate\Http\Request;
use App\Models\ContraceptionReason;
use App\Http\Controllers\Controller;
use App\Http\Resources\General\ContraceptionReasonResource;

class ContraceptionReasonContoroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $cr = ContraceptionReason::all();

        return ContraceptionReasonResource::collection($cr);
    }

    /**
     * Display the specified resource.
     *
     * @param  ContraceptionReason  $reason
     * @return \Illuminate\Http\Response
     */
    public function show(ContraceptionReason $reason)
    {
        $reason->load('profiles');

        return new ContraceptionReasonResource($reason);
    }
}
