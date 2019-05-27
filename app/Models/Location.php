<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Location extends Model
{
	
	use SoftDeletes;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'country_id' ];


    /**
     * The state for this location.
     * 
     * @return [type] [description]
     */
    public function state()
    {
    	return $this->belongsTo(State::class);
    }

    /**
     * The country this location is in.
     * 
     * @return [type] [description]
     */
    public function country()
    {
    	return $this->belongsTo(Country::class);
    }

    /**
     * Gets all the clinics that are in a specific 
     * location.
     * 
     * @return [type] [description]
     */
    public function clinics()
    {
        return $this->morphedByMany(Clinic::class, 'locatable');
    }
}
