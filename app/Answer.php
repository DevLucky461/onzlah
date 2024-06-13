<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Answer extends Model
{
    use SoftDeletes;

    protected $table = 'answers';
    
    protected $fillable = [
       'answer',
       'status',
       'fired',
       'question_id',
    ];

    public function questions()
    {
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }

    public function user_question(){
        return $this->hasMany('App\User_Question');
    }


}
