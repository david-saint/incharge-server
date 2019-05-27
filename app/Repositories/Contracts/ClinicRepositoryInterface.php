<?php

namespace App\Repositories\Contracts;

interface ClinicRepositoryInterface extends QueryableInterface
{
	/**
	 * Filters for clinics within a specific radius
	 * of longitude and latitude.
	 * @param  [type] $request [description]
	 * @param  [type] $query   [description]
	 * @return [type]          [description]
	 */
	public function applyDistanceMatrixFilter($request, $query);
}
