<?php

namespace App\Repositories\Concrete;

use App\Models\Clinic;
use Illuminate\Http\Request;
use App\Repositories\Contracts\ClinicRepositoryInterface;
use App\Repositories\Contracts\RequestRelationshipParserInterface;

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

        $this->queryFields = [ 'id', 'name', 'address', 'locations' => [ 'name' ] ];

        $this->builder = (static::MODEL)::query();
	}
}
