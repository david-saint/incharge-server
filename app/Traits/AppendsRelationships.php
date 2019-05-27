<?php

namespace App\Traits;

use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;

trait AppendsRelationships
{

    /**
     * @param Request $request
     * @param $queryable
     * @param array $allowed
     * @param string|\App\Repositories\Concrete\RequestRelationshipParser $withBuilder
     * @return \Illuminate\Database\Eloquent\Model | \Illuminate\Database\Query\Builder
     */
    public function appendQueryRelationships(Request $request, $queryable, $allowed = [], $withBuilder = 'withBuilder')
    {
        if ($request->has('with')) {
            $builder = is_object($withBuilder) ? $withBuilder : ($this->{$withBuilder} ?? app(\App\Repositories\Contracts\RequestRelationshipParserInterface::class));
            $relations = $builder->setAllowedRelationships($allowed)->parse($request->with);

            // If there are relationships that should be loaded by default
            // no matter if it was set on the request add it to the
            // loaded relations.
            if (property_exists($this, 'defaultRelationships'))
                $relations->add($this->defaultRelationships);

            if (count($relations)) {
                if ($queryable instanceof Model) {
                    return $queryable->load($relations->toArray());
                }
                return $queryable->with($relations->toArray());
            }

        }

        return $queryable;
    }
}
