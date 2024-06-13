<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Claim extends Model
{
    protected $table = 'claims';
    protected $fillable = [
        'user_id',
        'reward_count_id',
        'reward_code',
        'status',   // valid / used / expired
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
    public function reward_count(){
        return $this->belongsTo('App\Reward_Count', 'reward_count_id', 'id');
    }
}
