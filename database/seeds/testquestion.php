<?php

use Illuminate\Database\Seeder;

class testquestion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_ids = \App\User::all()->pluck('id');
        $event = \App\Event::where('id', 1)->with('question')->first();
        for ($i = 0; $i < 30; $i++){
            $user = \App\User_Event::create([
                'user_id' => $user_ids[$i+1],
                'event_id' => 1,
                'user_status' => 'pass',
                'order' => 4,
                'used_life' => 0,
            ]);
            for ($j = 0; $j < 4; $j++){
                $answer = \App\Answer::where('question_id', $j+1)->get()->random();
                $user_question = \App\User_Question::create([
                    'question_id' => $j+1,
                    'user_id' => $user->id,
                    'answer_id' => $answer->id,
                    'status' => $answer->status,
                ]);
                if($answer->status == 'wrong') {
                    $user->update([
                        'user_status' => 'fail',
                    ]);
                    break;
                }
            }
        }

    }
}
