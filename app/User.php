<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Database\Eloquent\SoftDeletes;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements MustVerifyEmail,JWTSubject
{
    use Notifiable, HasRoles, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'gender',
        'phonenumber',
        'picture',
        'email',
        'current_states',
        'current_city',
        'referral_code',
        'email_verified_at',
        'password',
        'coins',
        'life',
        'verify',
        'verificationcode'
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    public static function checkToken($token){
        if($token->token){
            return true;
        }
        return false;
    }


    protected $hidden = [
        'password', 'remember_token',
    ];


    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function events(){
        return $this->belongsToMany('App\Event', 'user_event', 'user_id', 'event_id');
    }

    public function friends(){
        return $this->hasMany('App\Friend');
    }

    public function user_question(){
        return $this->hasMany('App\User_Question');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }

    public function voucher(){
        return $this->hasMany('App\Voucher');
    }

    public function referral(){
        return $this->hasMany('App\UserReferral');
    }
    public function messages(){
        return $this->hasMany('\App\Message');
    }
    public function feedbacks(){
        return $this->hasMany('\App\Feedback');
    }
}
