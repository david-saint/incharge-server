<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model
{

	use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'code' ];


    /**
     * The states in this country.
     * 
     * @return [type] [description]
     */
    public function states()
    {
    	return $this->hasMany(State::class);
    }
}
