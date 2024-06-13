<?php

use Illuminate\Database\Seeder;
use App\Event;
use App\Question;
use App\Answer;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = \Faker\Factory::create();
        $entries = 4;

        $event = Event::all();
        foreach($event as $e){
            for ($i = 0; $i < $entries; $i++){
                $number1 = $faker->numberBetween(1,100);
                $number2 = $faker->numberBetween(1,100);
                $total = $number1 + $number2;

                $question = Question::create([
                    'event_id' => $e->id,
                    'question' => 'what is '.$number1.' plus '.$number2.'?',
                    'fired' => 'false',
                ]);

                Answer::create([
                    'question_id' => $question->id,
                    'answer' => $total,
                    'status' => 'correct',
                ]);

                for ($j = 0; $j < 3; $j++){
                    $answer = Answer::create([
                        'question_id' => $question->id,
                        'answer' => $faker->numberBetween(2,200),
                        'status' => 'wrong',
                    ]);
                }
            }
        }
    }
}
