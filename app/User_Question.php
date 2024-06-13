<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class User_Question extends Model
{
    use SoftDeletes;
    protected $table = 'user_question';
    protected $fillable = [
        'question_id',
        'user_id',
        'answer_id',
        'status'
    ];

    public function answers(){
        return $this->belongsTo('App\Answer', 'answer_id', 'id');
    }

    public function users(){
        return $this->belongsTo('App\User', 'user_id', 'id');
    }

    public function questions(){
        return $this->belongsTo('App\Question', 'question_id', 'id');
    }
}
