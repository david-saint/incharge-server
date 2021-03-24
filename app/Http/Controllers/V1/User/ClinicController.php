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

    public function getClinics()
    {
        $clinics = Clinic::paginate(50);
        return response()->json($clinics, 200);   
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
            'name' => ['required','string'],
            'address' => ['required','string'],
            'latitude' => ['required','numeric'],
            'longitude' => ['required','numeric'],
            'added_by_id' => ['required','numeric']
        ]);
        
        $clinic = Clinic::create($request->all());
        if($clinic){
            return response()->json('done', 201);
        }
    }

    public function deletedClinic(){
        $clinics = Clinic::onlyTrashed()->get();
        return response()->json($clinics, 200);  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Clinic $useclinicsrs
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $clinic = Clinic::findOrFail($id);
        $res = $clinic->update($request->only('name', 'address', 'latitude', 'longitude', 'added_by_id'));
        if($res){
            return response()->json('Updated', 200);
        } else {
            return response()->json('Not Updated', 501);
        }
    }

    public function revertDelete($id)
    {
        $clinic = Clinic::withTrashed()->find($id)->restore();
        if($clinic){
            return response()->json('restored', 200);
        } else {
            return response()->json('not restored', 501);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Clinic  $clinics
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Clinic::findOrFail($id);
        $res = $user->delete();
        
        if($res == 1){
            return response()->json('Done', 200);
        } else {
            return response()->json('Not done', 501);
        }
    }
}
