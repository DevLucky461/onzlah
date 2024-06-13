<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    protected $table = 'questions';
    protected $fillable = [
        'question_type',
        'question',
        'question_image',
        'event_id',
        'fired'
    ];


    public function events()
    {
        return $this->belongsTo('App\Event', 'event_id', 'id');
    }

    public function answer()
    {
        return $this->hasMany('App\Answer');
    }

    public function user_question(){
        return $this->hasMany('App\User_Question');
    }

    public function question_order(){
        return $this->hasOne('App\QuestionOrder');
    }

}
