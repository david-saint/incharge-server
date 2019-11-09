<?php

namespace App\Http\Filters;

use Closure;
use Illuminate\Support\Str;

abstract class Filter
{
	/**
	 * This would handle this filter.
	 * 
	 * @param  Illuminate\Database\Query\Builder  $request
	 * @param  Closure $next
	 * @return Illuminate\Database\Query\Builder
	 */
	public function handle($request, Closure $next)
	{
		/**
		 * This would cheeck if the request contains a value
		 * for the key this filter handles.
		 */
		if (! request()->filled($this->filterKey()))
			return $next($request);


		$builder = $next($request);

		/**
		 * Should return the applied filter defined by the 
		 * parent class.
		 */
		return $this->apply($builder);
	}

	/**
	 * This would apply some query logic to the builder 
	 * passed into it.
	 * 
	 * @param  Illuminate\Database\Query\Builder $builder
	 * @return Illuminate\Database\Query\Builder
	 */
	abstract protected function apply($builder);

	/**
	 * Get the key in the request that corresponds 
	 * to the filter.
	 * 
	 * @return string
	 */
	protected function filterKey()
	{
		/**
		 * If you define a key method on the parent class
		 * that would be used as the filter's key.
		 */
		if (method_exists($this, 'key'))
			return $this->key();

		/**
		 * If there's no method called key, but there's a
		 * property on the parent class called key then
		 * that would be used as the filter's key.
		 */
		if (property_exists($this, 'key'))
			return $this->key;

		/**
		 * Finally if none of the previous checks pass then 
		 * we'll generate a key based on the class name
		 * so a class called UserType would check for
		 * user_type key in the request.
		 */
		return Str::snake(
			Str::endsWith(class_basename($this), 'Filter')
				? Str::replaceLast('Filter', '', class_basename($this))
				: class_basename($this)
		);
	}

	/**
	 * Returns the value set on the request for the specified 
	 * filter key.
	 * 
	 * @return string|mixed
	 */
	protected function keyValue()
	{
		return request($this->filterKey());
	}
}