<?php

namespace App\Http\Controllers\V1\User;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Users\ClinicResource;
use App\Repositories\Contracts\ClinicRepositoryInterface;

/**
 * Clinic related functionns served to users.
 * @package  App\Http\Controllers\
 */
class ClinicController extends SearchableController
{
    
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
     * @param ClinicRepositoryInterface $repo
     */
    public function __construct(ClinicRepositoryInterface $repo)
    {
    	parent::__construct();
    	$this->repo = $repo;
    	$this->allowedRelationships = [
    		'locations',
    	];
    }

    /**
     * Get all the clinics.
     * 	
     * @param  Request $request [description]
     * @return ClinicResource
     */
    public function index(Request $request)
    {
    	$query = $this->repo
    				->setAllowedRelationships($this->allowedRelationships)
                    ->queryAll($request);

        return ClinicResource::collection($request->hasAny(['page', 'per_page']) ?
        	$query->paginate($request->per_page ?? 20) :
        	$query->get()
    	);
    }
}
