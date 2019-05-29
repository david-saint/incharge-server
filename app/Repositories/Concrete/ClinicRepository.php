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
	 * Filter the query based on the request.
	 * 
	 * @param  [type] $request [description]
	 * @param  [type] $query   [description]
	 * @return [type]          [description]
	 */
	public function applyFilters($request, $query)
	{
		// Apply filters here.
		$this->applyDistanceMatrixFilter($request, $query);
	}

	/**
	 * Filters for clinics within a specific radius
	 * of a longitude and latitude.
	 * 
	 * @param  [type] $request [description]
	 * @param  [type] $query   [description]
	 * @return [type]          [description]
	 */
	public function applyDistanceMatrixFilter($request, $query)
	{
		if ($request->filled(['longitude', 'latitude'])) {
			// Determine the mode defaults to 'kilometers'
			$mode = in_array(strtolower($request->mode), ['km', 'mi']) ? $request->mode : 'km';
			// Determine the circle radius defaults to 10 'kilometers' or 'miles'
			$radius = filter_var($request->radius, FILTER_VALIDATE_INT) !== false ? $request->radius : 10;
			// haversine constant depending on the mode.
			$constant = (strtolower($mode) === 'km') ? 6371 : 3959;
			// Query the database.
			$query->select('clinics.*')
				->selectRaw(
					'( ? * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
					[ $constant, $request->latitude, $request->longitude, $request->latitude ]
				)
				->whereRaw(
					'( ? * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )  < ?',
					[ $constant, $request->latitude, $request->longitude, $request->latitude, $radius ]
				);
		}

		return $query;
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
