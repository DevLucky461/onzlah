<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class NotificationSettings extends Model
{
    use SoftDeletes;
    protected $table = 'notificationsettings';
    protected $fillable = [
        "user_id",
        "setting",
        "email",
        "in_app",
    ];

    public function users(){
        return $this->belongsTo('App\User','user_id', 'id');
    }
}
