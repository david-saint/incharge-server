<?php

namespace App\Traits;

trait WhereBuilder
{

	/**
	 * Serarching through a queryable repository.
	 * 
	 * @param  [type]  $search   [description]
	 * @param  [type]  $fields   [description]
	 * @param  [type]  $builder  [description]
	 * @param  boolean $whereHas [description]
	 * @return [type]            [description]
	 */
	protected function queryWhereBuilder($search, $fields = null,$builder = null, $whereHas = false)
	{
		$builder = $builder ?: $this->builder;
		$fields = $fields ?: $this->queryFields;

		foreach ($fields as $field => $value) {
			if (!$whereHas) {
				if (!is_array($value)){
					$builder = $builder->orWhere($value, 'like', "%".$search."%");
				}
				else {
					$builder = $this->queryWhereBuilder($search, $value, $builder, $field);
				}
			}
			else {
				if (! is_array($value)) {
					$builder = $builder->orWhereHas($whereHas, function($query) use ($search,$value){
						$query->where($value, 'like', "%".$search."%");
					});
				} else {
					$builder = $this->queryWhereBuilder($search, $value, $builder, "$whereHas.$field");
				}
			}
		}

		return $builder;
	}
}
