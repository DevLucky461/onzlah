<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class feedback extends Model
{
    use SoftDeletes;

    protected $table = 'feedbacks';
    protected $fillable = [
        'user_id',
        "exp",
        "rating",
        "frequency",
        "recommend",
        "comment",
    ];

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }
}
