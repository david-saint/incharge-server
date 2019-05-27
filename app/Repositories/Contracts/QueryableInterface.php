<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface QueryableInterface
{

    /**
     * @param Request $request
     * @param null $fields
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function queryAll(Request $request, $fields = null);

    /**
     * @param $request
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function applyFilters($request, $query);

    /**
     * @param $relationships
     * @return $this
     */
    public function setAllowedRelationships($relationships);

    /**
     * @param Request $request
     * @param $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function order(Request $request, $query);


    /**
     * @param $query
     * @return $this
     */
    public function setQuery($query);

    /**
     * @param Request $request
     * @param $queryable
     * @param array $allowed
     * @param string|\App\Repositories\Concrete\RequestRelationshipParser $withBuilder
     * @return \Illuminate\Database\Eloquent\Model | \Illuminate\Database\Query\Builder
     */
    public function appendQueryRelationships(Request $request, $queryable, $allowed = [], $withBuilder = 'withBuilder');

    /**
     * @param $query
     * @param $request
     * @return $this
     */
    public function appendAggregates($query, $request);

    /**
     * @param $query
     * @param $request
     * @return $this
     */
    public function appendCounts($query, $request);
}