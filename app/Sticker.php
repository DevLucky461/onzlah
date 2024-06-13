<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sticker extends Model
{
    protected $table = 'stickers';
    protected $fillable = [
        'sticker_name',
        'src',
        'sticker_cost',
    ];

    public function event() {
        return $this->belongsToMany('App\Event','sticker_states');
    }
}
