<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes;

    protected $table = 'notifications';

    protected $fillable = [
        "user_id",
        "notification",
        "type",
        "status",
    ];

    public function users(){
        return $this->belongsTo('App\User','user_id', 'id');
    }

    
}
