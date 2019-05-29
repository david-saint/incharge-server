<?php

namespace App\Http\Controllers\V1\User;

use App\Http\Controllers\Controller;
use App\Traits\AppendsRelationships;
use App\Repositories\Contracts\RequestRelationshipParserInterface;

/**
 * Controllers that can be searched through.
 * @package  App\Http\Controllers\
 */
abstract class SearchableController extends Controller
{
	use AppendsRelationships;

	/**
	 * The default relationship Parser.
	 * @var RequestRelationshipParserInterface
	 */
	protected $withBuilder;
  
  	/**
  	 * The default allowed relationships.
  	 * @var array
  	 */
	protected $allowedRelationships = [];

	/**
	 * Initialize each componenet with a relationship parser.
	 */
	public function __construct()
    {
        $this->withBuilder = app(RequestRelationshipParserInterface::class);
    }
}
