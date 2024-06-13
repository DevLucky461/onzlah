<?php

use Illuminate\Database\Seeder;
use App\Question;
use App\User_Event;
Use App\User_Question;
use App\Event;
use App\QuestionOrder as Order;

class Unfire extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Question::where('fired', 'true')->update(['fired' => 'false']);
        Event::where('question_state','!=', '0')->update(['question_state' => '0']);
        User_Event::truncate();
        User_Question::truncate();
        Order::truncate();
        \App\User::where('life', '<', '10')->update([
            'life' => 10,
        ]);
    }
}
