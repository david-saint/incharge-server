<?php

namespace App\Repositories\Concrete;

use App\Repositories\Contracts\RequestRelationshipParserInterface;

class RequestRelationshipParser implements RequestRelationshipParserInterface, \IteratorAggregate
{
	/**
	 * @var
	 */
	protected $allowed;

	/**
	 * @var array
	 */
	protected $withArray = [];
	

	/**
	 * Returns the count of the loaded array.
	 * 
	 * @return [type] [description]
	 */
	public function count()
	{
		return count($this->withArray);
	}

	/**
	 * returns the with as an array.
	 * 
	 * @return array
	 */
	public function toArray() : array
	{
		return $this->withArray;
	}

	/**
	 * returns the relationships as a string.
	 * 
	 * @return string
	 */
	public function toString() : string
	{
		return join(",",$this->withArray);
	}

	/**
	 * Sets the relationships that are allowed.
	 * 
	 * @param array|mixed $relationships
	 * @return $this
	 */
	public function setAllowedRelationships( $relationships = []) : RequestRelationshipParserInterface
	{
		$this->allowed = $this->processArrayToDots(is_array($relationships) ? $relationships : func_get_args());
		return $this;
	}

	/**
	 * 
	 * @param  [type] $array  [description]
	 * @param  string $prefix [description]
	 * @return [type]         [description]
	 */
	public function processArrayToDots($array, $prefix = '')
	{
		$results = [];

		foreach ($array as $key => $value) {
			if (is_array($value) && ! empty($value)) {
				$results = array_merge( $results, $this->processArrayToDots($value, $prefix.$key.'.'));
			} else {
				$results[] = $prefix.$value;
			}
		}
		return $results;
	}

	/**
	 * @param $with
	 * @return $this
	 */
	public function parse($with) : RequestRelationshipParserInterface
	{
		$with = is_string($with) ? explode(',', $with) : $with;
		$data = [];
		foreach ($with as $rel) {
			$this->deepParse($rel, $this->allowed, $data);
		}
		$this->withArray = $data;
		return $this;
	}

	/**
	 * @param $rel
	 * @param $allowed
	 * @param $data
	 */
	protected function deepParse($rel, $allow, &$data)
	{
		foreach ($allow as $key => $allowed) {
			if (!is_array($allowed)) {
				preg_match("/^$rel(\..+|$)/", $allowed) ? $data[] = $rel : null;
			}
		}
	}

	/**
	 * Add a value to the withArray.
	 * 
	 * @param [type] $val [description]
	 */
	public function add($val)
	{
		if (!is_array($val)) {
			$this->withArray[] = $val;
			return $this;
		}

		foreach ($val as $relationship => $constraint) {
			$this->withArray[$relationship] = $constraint;
		}
		return $this;
	}

	/**
	 * This is for the Itterator aggregate interface.
	 * 
	 * @return [type] [description]
	 */
	public function getIterator()
	{
		return new \ArrayIterator($this->toArray());
	}
}