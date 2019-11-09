<?php

namespace App\Http\Filters;

use App\Http\Filters\Filter;

/**
 * @package Filters
 */
class DistanceMatrixFilter extends Filter
{
	/**
	 * the parameters on the request that's meant to be
	 * set so this filter can work.
	 * @var array
	 */
	protected $key = [ 'longitude', 'latitude' ];

	/**
	 * This would apply some query logic to the builder 
	 * passed into it.
	 * 
	 * @param  Illuminate\Database\Query\Builder $builder
	 * @return Illuminate\Database\Query\Builder
	 */
	protected function apply($builder)
	{
		info($this->keyValue());
		// Determine the mode defaults to 'kilometers'
		$mode = in_array(strtolower(request('mode')), ['km', 'mi']) ? request('mode') : 'km';
		// Determine the circle radius defaults to 10 'kilometers' or 'miles'
		$radius = filter_var(request('radius'), FILTER_VALIDATE_INT) !== false ? request('radius') : 10;
		// haversine constant depending on the mode.
		$constant = (strtolower($mode) === 'km') ? 6371 : 3959;

		// TODO: to make this more generic, instead of selecting clinics.*
		// make the clinics.* an attribute sent in the request...

		// Query the database.
		return $builder->select('clinics.*')
			->selectRaw(
				'( ? * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) ) AS distance',
				[ $constant, request('latitude'), request('longitude'), request('latitude') ]
			)
			->whereRaw(
				'( ? * acos( cos( radians(?) ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians(?) ) + sin( radians(?) ) * sin( radians( latitude ) ) ) )  < ?',
				[ $constant, request('latitude'), request('longitude'), request('latitude'), $radius ]
			);
	}
}
