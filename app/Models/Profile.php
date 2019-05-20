<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ ];

    /**
     * The attributes that should be mutated to dates.
     * 
     * @var array
     */
    protected $dates = [ 'date_of_birth' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ 'meta'	=>	'object' ];


    /**
     * Returns the user that owns this profile
     * 
     * @return [type] [description]
     */
   	public function user()
   	{
   		return $this->belongsTo(User::class);
   	}
}
