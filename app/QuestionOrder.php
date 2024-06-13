<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionOrder extends Model
{
    protected $table = 'question_order';
    protected $fillable = [
       'question_id',
       'event_id',
       'order'
    ];

    public function event(){
        return $this->belongsTo('App\Event');
    }
    public function question(){
        return $this->belongsTo('App\question');
    }
}
