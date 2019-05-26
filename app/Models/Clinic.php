<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clinic extends Model
{
    
	use SoftDeletes;

	/**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The Locations that you can find this clinic.
     * 
     * @return [type] [description]
     */
    public function locations()
    {
    	return $this->morphToMany(Location::class, 'locatable');
    }
}
