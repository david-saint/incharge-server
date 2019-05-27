<?php
/**
 * Created by PhpStorm.
 * User: nonso
 * Date: 27/04/2018
 * Time: 12:19 PM
 */

namespace App\Traits;


trait JwtSubjectable
{
	
	/**
	 * Get the identifier that will be stored in the subject claim of the JWT.
	 *
	 * @return mixed
	 */
	public function getJWTIdentifier()
	{
		return $this->getKey();
	}

	/**
	 * Return a key value array, containing any custom claims to be added to the JWT.
	 *
	 * @return array
	 */
	public function getJWTCustomClaims()
	{
		return [];
	}

}