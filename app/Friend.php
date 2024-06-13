<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Friend extends Model
{
    use SoftDeletes;
    protected $table = 'friends';
    protected $fillable = [
        'user_id',
        'friend_id',
        'status'
    ];

    public function friends(){
        return $this->belongsTo('App\User', 'friend_id', 'id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

}
