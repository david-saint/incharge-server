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

    public function getContent(FaqGroup $faq)
    {
    	$f = $faq->faq;

    	if (! $f) {
    		return response()->json([
				'status'	=>	'faq.get_content',
				'message'	=>	'Something went wrong when trying to get the faq',
				'error'		=>	app()->environment('production') ?: $e->getMessage(),
				'trace'		=>	app()->environment('production') ?: $e->getTrace(),
			], 500);
    	}

    	return response()->json([
    		'data'		=>	$f,
    		'status'	=>	'faq.get_content',
    	], 200);
    }
}
