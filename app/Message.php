<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $table = 'messages';

    protected $fillable = [
        "user_id",
        "message",
        "video_id",
    ];

    public function users(){
        return $this->belongsTo('App\User','user_id', 'id');
    }

    public function video(){
        return $this->belongsTo(Event::class, 'video_id', 'id');
    }
}
