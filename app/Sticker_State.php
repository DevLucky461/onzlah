<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sticker_State extends Model
{
    protected $table = 'sticker_states';
    protected $fillable = [
        'sticker_id',
        'event_id',
        'quantity',
    ];

    public function sticker(){
        return $this->belongsTo('App\Sticker');
    }
    public function event(){
        return $this->belongsTo('App\Event');
    }

}
