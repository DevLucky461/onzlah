<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Event extends Model
{
    use SoftDeletes;
    protected $table = 'user_event';
    protected $fillable = [
        'user_id',
        'event_id',
        'user_status',
        'order',
        'used_life'
    ];

    public function user(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }


}
