<?php

use Illuminate\Database\Seeder;
use App\Event;
use App\Question;
use App\Answer;

class TrialQuestion extends Seeder
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

        $event = Event::where('id', 1)->first();

        //----q1

        $question1 = Question::create([
            'event_id' => $event->id,
            'question' => 'In the world of Limitless Possibilities Spiderman with super powers have this famous saying "With Great Powers COmes Great Responisbilities"  Who said it?',
            'question_type' => 'text',
            'fired' => 'false',
        ]);
        Answer::create([
            'question_id' => $question1->id,
            'answer' => 'Peter Parker',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question1->id,
            'answer' => 'Uncle Ben',
            'status' => 'correct',
        ]);
        Answer::create([
            'question_id' => $question1->id,
            'answer' => 'Wolverine',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question1->id,
            'answer' => 'Mary Jane Watson',
            'status' => 'wrong',
        ]);

        //----q2

        $question2 = Question::create([
            'event_id' => $event->id,
            'question' => 'What is my IG handle?',
            'question_type' => 'text',
            'fired' => 'false',
        ]);
        Answer::create([
            'question_id' => $question2->id,
            'answer' => 'SeanLJE',
            'status' => 'correct',
        ]);
        Answer::create([
            'question_id' => $question2->id,
            'answer' => 'SeanLee',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question2->id,
            'answer' => 'LJen',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question2->id,
            'answer' => 'Sean2020',
            'status' => 'wrong',
        ]);

        //----q3
        
        $question3 = Question::create([
            'event_id' => $event->id,
            'question' => 'What is the real name of Batman in the movie?',
            'question_type' => 'text',
            //'question_image' => 'http://www.cutecatgifs.com/wp-content/uploads/2014/08/trdmll.gif',
            'fired' => 'false',
        ]);
        Answer::create([
            'question_id' => $question3->id,
            'answer' => 'Bruce Wayne',
            'status' => 'correct',
        ]);
        Answer::create([
            'question_id' => $question3->id,
            'answer' => 'Bruce Lee',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question3->id,
            'answer' => 'Bruce Banner',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question3->id,
            'answer' => 'Bruce Willis',
            'status' => 'wrong',
        ]);

        //----q4
        
        $question4 = Question::create([
            'event_id' => $event->id,
            'question' => 'How did Peter Parker get his superpowers? He was bitten by a...',
            'question_type' => 'text',
            //'question_image' => '/images/question/question-4-onzlah.png',
            'fired' => 'false',
        ]);
        Answer::create([
            'question_id' => $question4->id,
            'answer' => 'Ant',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question4->id,
            'answer' => 'Mosquito',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question4->id,
            'answer' => 'Spider',
            'status' => 'correct',
        ]);
        Answer::create([
            'question_id' => $question4->id,
            'answer' => 'Bee',
            'status' => 'wrong',
        ]);

        //----q5
        
        $question5 = Question::create([
            'event_id' => $event->id,
            'question' => 'What song does Baby Groot dance to at the end of the first Guardian of the Galaxy?',
            'question_type' => 'text',
            'fired' => 'false',
        ]);
        Answer::create([
            'question_id' => $question5->id,
            'answer' => 'I Gotta Feeling’ – Black Eyed Peas',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question5->id,
            'answer' => 'I Will Survive’ – Gloria Gaynor',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question5->id,
            'answer' => 'I Want It That Way’ – Backstreet Boys',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question5->id,
            'answer' => 'I Want You Back’ – The Jackson 5',
            'status' => 'correct',
        ]);

        //----q6
        
        $question6 = Question::create([
            'event_id' => $event->id,
            'question' => 'Who co-wrote the song ‘We Are The World’ with Michael Jackson?',
            'question_type' => 'text',
            'fired' => 'false',
        ]);
        Answer::create([
            'question_id' => $question6->id,
            'answer' => 'Steview Wonder',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question6->id,
            'answer' => 'Lionel Richie',
            'status' => 'correct',
        ]);
        Answer::create([
            'question_id' => $question6->id,
            'answer' => 'Kenny Rogers',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question6->id,
            'answer' => 'Bob Dylan',
            'status' => 'wrong',
        ]);

        //----q7
        
        $question7 = Question::create([
            'event_id' => $event->id,
            'question' => 'Do you know - Which of the following is TRUE?',
            'question_type' => 'text',
            'fired' => 'false',
        ]);
        Answer::create([
            'question_id' => $question7->id,
            'answer' => 'Olympic flag was designed in 1913',
            'status' => 'correct',
        ]);
        Answer::create([
            'question_id' => $question7->id,
            'answer' => 'Lee Dong Guk is a korean Basketball player',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question7->id,
            'answer' => 'FIFA HQ is located in Paris',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question7->id,
            'answer' => 'Sheep Counting is not an official sport',
            'status' => 'wrong',
        ]);

        //----q8
        
        $question8 = Question::create([
            'event_id' => $event->id,
            'question' => 'Fact that will blow your mind: Which of the following is wrong?',
            'question_type' => 'text',
            'fired' => 'false',
        ]);
        Answer::create([
            'question_id' => $question8->id,
            'answer' => 'Clams have feet',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question8->id,
            'answer' => 'A golf ball has 336 dimple',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question8->id,
            'answer' => 'Stars do not really twinkle',
            'status' => 'wrong',
        ]);
        Answer::create([
            'question_id' => $question8->id,
            'answer' => '45km is the first marathon distance',
            'status' => 'correct',
        ]);


    }
}
