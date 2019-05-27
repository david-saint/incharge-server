<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ContraceptionReason extends Model
{
    
	use SoftDeletes;

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
    protected $hidden = [];


    /**
     * The profiles that have this contraception reason.
     * 
     * @return [type] [description]
     */
    public function profiles()
    {
    	return $this->hasMany(Profile::class);
    }
}
