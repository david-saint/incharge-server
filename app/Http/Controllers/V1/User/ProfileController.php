<?php

namespace App\Http\Controllers\V1\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\HandlesAuthenticatedUser;

class ProfileController extends Controller
{
    
    /*
    |--------------------------------------------------------------------------
    | User Profile Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling anything that has to do with
    | the profile of a user. It handles the creation, updating, getting and 
    | deleting of the user profile
    |
    */
   
   use HandlesAuthenticatedUser;
   

   /**
    * This creates a profile for the authenticated
    * user if it doesn't already have one.
    * 
    * @param  Request $request [description]
    * @return [type]           [description]
    */
   public function createProfile(Request $request)
   {
   		$this->validate($request, [
   			'age'				=>	'requied|numeric',
   			'gender'			=>	'required|in:MALE,FEMALE,OTHER',
   			'dob'				=>	'required|array',
   			'dob.day'			=>	'required|numeric',
   			'dob.month'			=>	'required',
   			'dob.year'			=>	'required|numeric',
   			'address'			=>	'required|string',
   			'latitude'			=>	[ 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/' ],
   			'longitude'			=>	[ 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/' ],
   			'marital_status'	=>	'required|in:SINGLE,RELATIONSHIP',
   			'height'			=>	'numeric',
   			'weight'			=>	'numeric',
   			'education_level'	=>	'integer|exists:education_levels',
   			'occupation'		=>	'string',
   			'children'			=>	'numeric',
   			'reason'			=>	'required|numeric|exists:contraception_reasons',
   			'sexually_active'	=>	'required|boolean',
   			'pregnancy_status'	=>	'required|boolean',
   			'religion'			=>	'required|in:CHRISTIANITY,ISLAM,OTHER',
   			'religion_sect'		=>	'required_if:religion,CHRISTIANITY',
   		], [
   			'dob.day.required'		=>	'Please specify your birth day',
   			'dob.month.required'	=>	'Please specify your birth month',
   			'dob.year.reqiured'		=>	'Please specify your birth year',
   			'dob.year.numeric'		=>	'Your birth year is not valid',
        ]);

   		$dob = new Carbon("{$request->dob['day']} {$request->dob['month']} {$request->dob['year']}");

   		$formatted = [
			'date_of_birth'				=>	$dob,
			'contraception_reason_id'	=>	$request->reason,
			'number_of_children'		->	$request->children,
			'education_level_id'		=>	$request->education_level,
   		];

   		// merge the request data with the formated data.
   		$data = array_merge($request->all(), $formatted);

   		try
   		{
   			// This retrieves the authenticated user
   			$user = $this->user();
   			// Then we create a profile for it.
	   		$profile = $user->profile()->create($data);

   		} catch (\Exception $e)
   		{
   			return response()->json([
   				'status'	=>	'profile.create',
   				'message'	=>	'Something went wrong when creating the profile',
   				'error'		=>	app()->environment('production') ?: $e->getMessage(),
   				'trace'		=>	app()->environment('production') ?: $e->getTrace(),
   			], 500);
   		}

   		return response()->json([
   			'status'	=>	'profile.create',
   			'message'	=>	'Successfully Created the User\'s Profile',
   		], 201);
   }

   /**
    * This updates the currently logged in user's 
    * profile.
    * 
    * @param  Request $request [description]
    * @return [type]           [description]
    */
   public function updateProfile(Request $request)
   {
   		$this->validate($request, [
   			'age'				=>	'requied|numeric',
   			'gender'			=>	'required|in:MALE,FEMALE,OTHER',
   			'dob'				=>	'required|array',
   			'dob.day'			=>	'required|numeric',
   			'dob.month'			=>	'required',
   			'dob.year'			=>	'required|numeric',
   			'address'			=>	'required|string',
   			'latitude'			=>	[ 'regex:/^[-]?(([0-8]?[0-9])\.(\d+))|(90(\.0+)?)$/' ],
   			'longitude'			=>	[ 'regex:/^[-]?((((1[0-7][0-9])|([0-9]?[0-9]))\.(\d+))|180(\.0+)?)$/' ],
   			'marital_status'	=>	'required|in:SINGLE,RELATIONSHIP',
   			'height'			=>	'numeric',
   			'weight'			=>	'numeric',
   			'education_level'	=>	'integer|exists:education_levels',
   			'occupation'		=>	'string',
   			'children'			=>	'numeric',
   			'reason'			=>	'required|numeric|exists:contraception_reasons',
   			'sexually_active'	=>	'required|boolean',
   			'pregnancy_status'	=>	'required|boolean',
   			'religion'			=>	'required|in:CHRISTIANITY,ISLAM,OTHER',
   			'religion_sect'		=>	'required_if:religion,CHRISTIANITY',
   		], [
   			'dob.day.required'		=>	'Please specify your birth day',
   			'dob.month.required'	=>	'Please specify your birth month',
   			'dob.year.reqiured'		=>	'Please specify your birth year',
   			'dob.year.numeric'		=>	'Your birth year is not valid',
        ]);

   		$dob = new Carbon("{$request->dob['day']} {$request->dob['month']} {$request->dob['year']}");

   		$formatted = [
			'date_of_birth'				=>	$dob,
			'contraception_reason_id'	=>	$request->reason,
			'number_of_children'		->	$request->children,
			'education_level_id'		=>	$request->education_level,
   		];

   		// merge the request data with the formated data.
   		$data = array_merge($request->all(), $formatted);

   		try
   		{
   			// This retrieves the authenticated user
   			$user = $this->user();
   			// Then we create a profile for it.
	   		$profile = $user->profile()->update($data);

   		} catch (\Exception $e)
   		{
   			return response()->json([
   				'status'	=>	'profile.update',
   				'message'	=>	'Something went wrong when updating the profile',
   				'error'		=>	app()->environment('production') ?: $e->getMessage(),
   				'trace'		=>	app()->environment('production') ?: $e->getTrace(),
   			], 500);
   		}

   		return response()->json([
   			'status'	=>	'profile.update',
   			'message'	=>	'Successfully updated the User\'s Profile',
   		], 201);
   }

   /**
    * Get the currently logged in user's profile.
    * 
    * @return [type] [description]
    */
   public function getProfile()
   {
   		$user = $this->user();

   		return $user->profile;
   }
}
