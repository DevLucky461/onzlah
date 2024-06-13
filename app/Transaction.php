<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'transaction_type',
        'transaction_value',
        'user_id',
        'event_id',
        'reward_id'
    ];

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function events(){
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }

    public function rewards(){
        return $this->belongsTo('App\Reward', 'reward_id', 'id');
    }
}
