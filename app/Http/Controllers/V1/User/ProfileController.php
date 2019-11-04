<?php

namespace App\Http\Controllers\V1\User;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Traits\HandlesAuthenticatedUser;
use App\Http\Resources\Users\ProfileResource;
use App\Repositories\Contracts\ProfileRepositoryInterface;

class ProfileController extends SearchableController
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
     * the repository instance.
     * @var ClinicRepositoryInterface
     */
    private $repo;

    /**
     * The default relationships.
     * @var array
     */
    protected $defaultRelationships;


    /**
     * Initialize the controller with the repository and allowed 
     * relationships.
     * @param ProfileRepositoryInterface $repo
     */
    public function __construct(ProfileRepositoryInterface $repo)
    {
    	parent::__construct();
    	$this->repo = $repo;
    	$this->allowedRelationships = [ 'user', 'reason', 'educationLevel' ];
    	$this->defaultRelationships = [ 'reason', 'educationLevel' ];
    }
	 

	/**
	 * This creates or updates a profile for the authenticated
	 * user if it doesn't already have one.
	 * 
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function save(Request $request)
	{
		$this->validate($request, [
			'age'				=>	'numeric',
			'gender'			=>	'required|in:MALE,FEMALE,OTHER',
			'dob'				=>	'date',
			'address'			=>	'string',
			'marital_status'	=>	'nullable|in:SINGLE,RELATIONSHIP',
			'height'			=>	'numeric',
			'weight'			=>	'numeric',
			'education_level'	=>	'integer|exists:education_levels,id',
			'occupation'		=>	'string',
			'children'			=>	'numeric',
			'reason'			=>	'nullable|numeric|exists:contraception_reasons,id',
			'sexually_active'	=>	'boolean',
			'pregnancy_status'	=>	'boolean',
			'religion'			=>	'in:CHRISTIANITY,ISLAM,OTHER',
			'religion_sect'		=>	'required_if:religion,CHRISTIANITY',
		]);

		$formatted = [
			'date_of_birth'				=>	$request->dob ?? Carbon::now(),
			'contraception_reason_id'	=>	$request->reason,
			'number_of_children'		=>	$request->children,
			'education_level_id'		=>	$request->education_level,
		];

		// merge the request data with the formated data.
		$data = array_merge($request->only([
			'age', 'gender', 'address', 'marital_status', 'height',
			'weight', 'occupation', 'sexually_active', 'pregnancy_status',
			'religion', 'religion_sect'	
		]), $formatted);

		try
		{
			// This retrieves the authenticated user
			$user = $this->user();
			// Then we create a profile for it.
			if ($user->profile) {
				$profile = tap($user->profile)->update($data);
			} else
				$profile = $user->profile()->create($data);

		} catch (\Exception $e)
		{
			Log::error($e->getMessage());
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
			'data'		=>	new ProfileResource($profile),
		], 201);
	}

	/**
	 * Get the currently logged in user's profile.
	 * 
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function index(Request $request)
	{
		$profile = $this->repo
    				->setAllowedRelationships($this->allowedRelationships)
    				->fetchForUser($request, $this->user());

		return new ProfileResource($profile);
	}

	/**
	 * Once a contraceptive plan has been set 
	 * for a profile, persist it to the database.
	 * 
	 * @param Request $request [description]
	 */
	public function setAlgorithmPlan(Request $request)
	{
		$this->validate($request, [
			'plan'	=>	'required',
		]);

		try
		{
			$profile = $this->user()->profile;
			// Save the plan on the user's profile
			$profile->setAttribute('meta->contraceptive_plan', $request->plan);
			$profile->save();

		} catch (\Exception $e)
		{
			return response()->json([
				'status'	=>	'profile.setAlgorithmPlan',
				'message'	=>	'Something went wrong when setting the algorithm plan',
				'error'		=>	app()->environment('production') ?: $e->getMessage(),
				'trace'		=>	app()->environment('production') ?: $e->getTrace(),
			], 500);
		}

		return response()->json([
			'status' 	=>	'profile.setAlgorithmPlan',
			'message'	=>	'Successfully set the algorithm plan.',
			'data'		=>	$request->plan
		], 200);
	}
}
