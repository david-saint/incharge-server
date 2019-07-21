<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqGroup extends Model
{
    
    /**
     * The attributes that aren't mass assignable.
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
    public function faqs()
    {
    	return $this->hasMany(Faq::class);
    }
}
