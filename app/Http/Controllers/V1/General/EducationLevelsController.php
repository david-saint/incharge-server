<?php

namespace App\Http\Controllers\V1\General;

use Illuminate\Http\Request;
use App\Models\EducationLevel;
use App\Http\Controllers\Controller;
use App\Http\Resources\General\GenericNamedResource;

class EducationLevelsController extends Controller
{
	/**
	 * Get all the education levels.
	 * 
	 * @return [type] [description]
	 */
	public function index()
	{
		$el = EducationLevel::all();

		return GenericNamedResource::collection($el);
	}
}
