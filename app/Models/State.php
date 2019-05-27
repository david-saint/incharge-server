<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

class State extends Model
{

	use Sluggable, SoftDeletes;

	/**
	 * The attributes that are mass assignable.
	 *
	 * @var array
	 */
	protected $fillable = [ 'name' ];


	/**
	 * The locations in this state.
	 * 
	 * @return [type] [description]
	 */
	public function locations()
	{
		return $this->hasMany(Location::class);
	}

	/**
	 *  Return the sluggable configuration array for this model.
	 *  
	 * @return [type] [description]
	 */
	public function sluggable()
	{
		return [
			'slug'	=>	[
				'source'	=>	'name',
			],
		];
	}
}
