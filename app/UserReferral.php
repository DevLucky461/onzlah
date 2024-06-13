<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserReferral extends Model
{
    use SoftDeletes;
    protected $table = 'user_referrals';
    protected $fillable = [
        'user_id',
        'referral_id',
    ];

    public function referral(){
        return $this->belongsTo('App\User', 'referral_id', 'id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


}
