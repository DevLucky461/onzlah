<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use SoftDeletes;
    protected $table = 'rewards';
    protected $fillable = [
        'cost_in_coins',
        'reward_type',
        'reward_name',
        'expiration_date'
    ];

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }
    public function reward_count(){
        return $this->hasMany('App\Reward_Count');
    }
    public function claim(){
        return $this->hasManyThrough('App\Claim','App\Reward_Count', 'reward_id', 'reward_count_id', 'id', 'id');
    }

}
