<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EducationLevel extends Model
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
    protected $hidden = [];


    /**
     * The profiles that have this contraception reason.
     * 
     * @return [type] [description]
     */
    public function profile()
    {
    	return $this->hasMany(Profile::class);
    }
}
