<?php

namespace App\Repositories\Concrete;

use App\Models\User;
use App\Models\Profile;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ProfileRepositoryInterface;
use App\Repositories\Contracts\RequestRelationshipParserInterface;

/**
 * Handles the logic behind profiles
 * @package  App\Repositories\
 */
class ProfileRepository extends QueryableRepository implements ProfileRepositoryInterface
{

	/**
	 * The Model of interest in this repository.
	 */
	const MODEL = Profile::class;

    /**
     * the default relationships
     * @var [type]
     */
    protected $defaultRelationships;

    /**
     * List of filters that you expect the 
     * request to run through. Note that the
     * filter at the bottom runs first.
     * 
     * @var array
     */
    protected $filters = [
    	// Include Filters here.
    ];

	/**
	 * Initiallize the repo setting the withBuilder, the queryable fields,
	 * and tthe builder for the model.
	 * 
	 * @param RequestRelationshipParserInterface $withBuilder [description]
	 */
	public function __construct(RequestRelationshipParserInterface $withBuilder)
	{
        $this->withBuilder = $withBuilder;
        // fields you can serarch for
        $this->queryFields = [ 'id', 'address', 'user' => [ 'id', 'name', 'email' ] ];
        // the builder to be used to form our query.
        $this->builder = (static::MODEL)::query();
        // the default relationships.
        $this->defaultRelationships = [ 'reason', 'educationLevel' ];
	}

    /**
     * Handle Sorting of the query.
     * 
     * @param  Request $request [description]
     * @param  [type]  $query   [description]
     * @return [type]           [description]
     */
    public function order(Request $request, $query)
    {
        if ($request->filled('sort')) {
            foreach (explode(',', $request->sort) as $col) {
                $col = explode('|', $col);
                $column = $col[0];
                $order = $col[1];

                switch ($column) {
                    default:
                        $query->orderBy($column, $order);
                        break;
                }
            }
        }
        return $query;
    }

    /**
     * Returns query for profile of a speccific user
     * @param  [type] $user [description]
     * @return [type]       [description]
     */
    public function queryByUser($user)
    {
    	$this->builder = (static::MODEL)::query()->where('user_id', $user->id);

    	return $this;
    }

    /**
     * Get the profile for a specific user.
     * @param  Request $request [description]
     * @param  [type]  $user    [description]
     * @return [type]           [description]
     */
    public function fetchForUser(Request $request, $user)
    {
    	$query = $this->queryByUser($user)->getQuery();

		$this->appendQueryRelationships($request, $query, $this->allowedRelationships);

		return $query->first();
    }

    /**
     * [appendCounts description]
     * 
     * @param  [type] $query   [description]
     * @param  [type] $request [description]
     * @return [type]          [description]
     */
    public function appendCounts($query, $request)
    {
        if ($request->filled('withCount')) {
            $query->withCount(explode(',', $request->withCount));
        }
    }


}
