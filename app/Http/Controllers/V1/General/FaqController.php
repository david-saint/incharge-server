<?php

namespace App\Http\Controllers\V1\General;

use App\Models\FaqGroup;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\General\FaqGroupResource;

class FaqController extends Controller
{
    //
    public function index()
    {
    	return FaqGroupResource::collection(FaqGroup::all());
    }
}
