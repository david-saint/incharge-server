<?php

namespace App\Repositories\Concrete;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ClinicRepositoryInterface;
use App\Repositories\Contracts\RequestRelationshipParserInterface;

/**
 * Handles the logic behind clinics
 * @package  App\Repositories\
 */
class ClinicRepository extends QueryableRepository implements ClinicRepositoryInterface
{

	/**
	 * The Model of interest in this repository.
	 */
	const MODEL = Clinic::class;

	/**
     * List of filters that you expect the 
     * request to run through. Note that the
     * filter at the bottom runs first.
     * 
     * @var array
     */
    protected $filters = [
    	// Include Filters here.
    	\App\Http\Filters\DistanceMatrixFilter::class,
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
        $this->queryFields = [ 'id', 'name', 'address', 'locations' => [ 'name' ] ];
        // the builder to be used to form our query.
        $this->builder = (static::MODEL)::query();
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
                	case 'distance':
                		if ($request->filled(['longitude', 'latitude'])) {
                			$query->orderBy($column, $order);
                		}
                		break;

                    default:
                        $query->orderBy($column, $order);
                        break;
                }
            }
        }
        return $query;
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
