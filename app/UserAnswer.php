<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserAnswer extends Model
{
    use SoftDeletes;
    protected $table = 'user_answer';
    protected $fillable = [
        'question_id',
        'user_id',
        'answer_id',
        'status',
    ];
}
