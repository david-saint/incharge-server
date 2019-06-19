<?php

namespace App\Repositories\Concrete;

use Illuminate\Http\Request;
use App\Traits\WhereBuilder;
use App\Traits\AppendsRelationships;

abstract class QueryableRepository
{

	use WhereBuilder, AppendsRelationships;

	/**
	 * @var RequestRelationshipParserInterface
	 */
	protected $withBuilder;

	/**
	 * @var array
	 */
	protected $queryFields = [];

	/**
	 * @var array
	 */
	protected $allowedRelationships = [];

	/**
	 * @var \Illuminate\Database\Query\Builder
	 */
	protected $builder;


	/**
	 * Sets the allowed relationships.
	 * 
	 * @param [type] $relationships [description]
	 */
	public function setAllowedRelationships($relationships)
	{
		$this->allowedRelationships = is_array($relationships) ? $relationships : func_get_args();
		return $this;
	}

	/**
	 * Set a query.
	 * 
	 * @param [type] $query [description]
	 */
	public function setQuery($query)
	{
		$this->builder = $query;
		return $this;
	}

	/**
	 * Returns the query.
	 * @return [type] [description]
	 */
	public function getQuery()
	{
		return $this->builder;
	}

	/**
	 * Query all the datasets.
	 * 
	 * @param  Request $request [description]
	 * @param  [type]  $fields  [description]
	 * @return [type]           [description]
	 */
	public function queryAll(Request $request, $fields = null)
	{
		$query = $request->search ? $this->builder->where(function ($q) use ($request, $fields) {
			$this->queryWhereBuilder($request->search, $fields, $q);
		}) : $this->builder;

		$this->applyFilters($request, $query);

		$this->appendCounts($query, $request);

		$this->appendAggregates($query, $request);



		if($request->withTrashed) $query->withTrashed();
		elseif($request->onlyTrashed) $query->onlyTrashed();

		$this->appendQueryRelationships($request, $query, $this->allowedRelationships);

		$this->order($request, $query);

		return $query;
	}

	/**
	 * append counts.
	 * 
	 * @param  [type] $query   [description]
	 * @param  [type] $request [description]
	 * @return [type]          [description]
	 */
	public function appendCounts($query, $request)
	{
		//
	}

	/**
	 * Append aggregagtes.
	 * 
	 * @param  [type] $query   [description]
	 * @param  [type] $request [description]
	 * @return [type]          [description]
	 */
	public function appendAggregates($query, $request)
	{
		//
	}
}