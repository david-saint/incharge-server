<?php

namespace App\Models;

use App\Traits\JwtSubjectable;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use App\Notifications\User\ResetPassword;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Traits\MustVerifyEmail as MustVerifyEmailTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject, MustVerifyEmail
{

    use Notifiable, SoftDeletes, JwtSubjectable, MustVerifyEmailTrait;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [ 'name', 'email', 'password' ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [ 'password', 'remember_token' ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [ 'email_verified_at' => 'datetime' ];

    /**
     * The name of the route that handles
     * this models email verification.
     * 
     * @var string
     */
    protected $verificationRoute = 'v1::user.verification.verify';


    /**
     * the profile created for this user
     * @return [type] [description]
     */
    public function profile()
    {
        return $this->hasOne(Profile::class);
    }

    /**
     * Send the password reset email.g
     * 
     * @param string $token
     * @return [type]        [description]
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
