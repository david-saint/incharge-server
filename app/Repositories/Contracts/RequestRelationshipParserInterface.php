<?php

namespace App\Repositories\Contracts;

interface RequestRelationshipParserInterface extends \Countable
{
	/**
	 * Converts teh request relationship to an 
	 * array.
	 * 
	 * @return [type] [description]
	 */
    public function toArray() : array;

    /**
     * Converts the relationshionships on the 
     * request to a string.
     * 
     * @return [type] [description]
     */
    public function toString() : string;

 	/**
 	 * Sets the allowed relationships.
 	 * 
 	 * @param array $relationships [description]
 	 */
    public function setAllowedRelationships( $relationships = []) : RequestRelationshipParserInterface;

    /**
     * Parses the request.
     * 
     * @param  [type] $with [description]
     * @return [type]       [description]
     */
    public function parse($with) : RequestRelationshipParserInterface;
}