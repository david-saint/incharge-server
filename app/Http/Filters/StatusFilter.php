<?php

namespace App\Http\Filters;

/**
 * @package Filters
 */
class StatusFilter extends Filter
{

	/**
	 * This would apply some query logic to the builder 
	 * passed into it.
	 * 
	 * @param  Illuminate\Database\Query\Builder $builder
	 * @return Illuminate\Database\Query\Builder
	 */
	protected function apply($builder)
	{
		// get the request key value
		$keyValue = $this->keyValue();

		return $builder->where('status', function ($q) use ($keyValue) {
            $q->where('id', $keyValue);
		});
	}
}
