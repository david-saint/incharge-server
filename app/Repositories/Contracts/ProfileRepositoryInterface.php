<?php

namespace App\Repositories\Contracts;

use Illuminate\Http\Request;

interface ProfileRepositoryInterface extends QueryableInterface
{
	/**
	 * Filters for Profiles belonging to a specific
	 * user.
	 * @param  User $user [description]
	 * @return [type]          [description]
	 */
	public function queryByUser($user);

	/**
	 * Fetch the profile for a specifuc user.
	 * @param  Request $request [description]
	 * @param  User    $user    [description]
	 * @return [type]           [description]
	 */
	public function fetchForUser(Request $request, $user);
}
