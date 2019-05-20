<?php

namespace App\Traits;

trait HandlesAuthenticatedUser
{

	/**
	 * Returns the currently authenticated user
	 * 
	 * @param  string $guard [description]
	 * @return [type]        [description]
	 */
	public function user($guard = '')
	{
		return auth()->guard($guard)->user();
	}
}