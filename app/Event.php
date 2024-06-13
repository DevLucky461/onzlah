<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;
    protected $table = 'events';
    protected $fillable = [
        'event_name',
        'event_description',
        'event_host_name',
        'event_start_date',
        'event_end_date',
        'event_coins_prize_pool',
        'event_image_url',
        'stream_key',
        'question_state',
        'fb_live_url',
        'view_more_data',
    ];

    protected $dates = [
        "event_start_date",
        "event_end_date"
    ];

    public function users()
    {
        return $this->belongsToMany('App\Event', 'user_event', 'user_id', 'event_id');
    }

    public function question()
    {
        return $this->hasMany('App\Question');
    }

    public function transaction(){
        return $this->hasMany('App\Transaction');
    }

    public function sticker(){
        return $this->belongsToMany('App\Sticker', 'sticker_states');
    }
    public function question_order(){
        return $this->hasMany('App\QuestionOrder');
    }



}
