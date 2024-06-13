<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reward_Count extends Model
{
    protected $table = 'reward_counts';
    protected $fillable = [
        'reward_id',
        'integer',
        'unlist_date',
    ];

    public function reward(){
        return $this->belongsTo('App\Reward');
    }
    public function claim(){
        return $this->hasMany('App\Claim');
    }
}
