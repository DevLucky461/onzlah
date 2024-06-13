<?php

namespace App\Http\Controllers;

use App\Event;
use App\QuestionOrder;
use App\User_Question;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Question;
use App\Answer;

class RehearsalController extends Controller
{
    public function view()
    {
        return view('admin.rehearsal');
    }

    public function setQuestion(Request $request)
    {


        $currentset = Question::where('event_id', '1')->get();
        //dd($currentset);
        Question::where('fired', 'true')->update(['fired' => 'false']);
        Question::where('event_id', '1')->delete();
        Event::where('question_state', '!=', '0')->update(['question_state' => '0']);
        DB::table('user_event')->update([
            'user_status' => 'pass',
            'order' => '0',
            'used_life' => '0',
        ]);
        User_Question::truncate();
        QuestionOrder::truncate();

        $faker = Factory::create();
        $entries = 4;

        $event = Event::where('id', 1)->first();

        if ($request->set == 'monday') {

            //---------------------------------------------------------qset 1 monday
            //----q1

            $question1 = Question::create([
                'event_id' => $event->id,
                'question' => 'In the world of Limitless Possibilities, Spiderman with superpowers have this famous saying "With Great Powers, Comes with Great Responsibilities" who said it?',
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
                'question' => "How did Peter Parker get his superpowers? He was bitten by a...",
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
                'answer' => 'I Gotta Feeling by Black Eyed Peas',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'I Will Survive by Gloria Gaynor',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'I Want It That Way by Backstreet Boys',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'I Want You Back by The Jackson 5',
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
                'answer' => 'Stevie Wonder',
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
                'question' => 'What word do you see?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Listen',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Silent',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Enlist',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Intels',
                'status' => 'wrong',
            ]);

            //----q8

            $question8 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the following is wrong?',
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
                'answer' => 'A golf ball has 300 to 500 dimples',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Moon is bigger than the sun',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Malaysia declared independence in 1957',
                'status' => 'wrong',
            ]);
        } else if ($request->set == 'tuesday') {

            //------------------------------------------------------------------qset 2 tuesday
            //----q1

            $question1 = Question::create([
                'event_id' => $event->id,
                'question' => '
                What was the name of the actress who said, Shut up, just shut up. You had me at "hello"',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Dorothy Boyd ',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Renée Zellweger',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Julia Roberts',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Tom Cruise',
                'status' => 'wrong',
            ]);

            //----q2

            $question2 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of these Instagram handle is not a member of Black Pink?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '@Lalalalisa_m',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => ' @Jennierubyjane',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '@Sooyaaa__',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '@Roseanne-Park',
                'status' => 'correct',
            ]);

            //----q3

            $question3 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the following is not an iconic movie couple?',
                'question_type' => 'text',
                //'question_image' => 'http://www.cutecatgifs.com/wp-content/uploads/2014/08/trdmll.gif',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Rose and Jack, Titanic',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Baby and Johnny, Dirty Dancing',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Sally and Harry, When Harry Met Sally',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Adam & Eve, The Notebook',
                'status' => 'correct',
            ]);

            //----q4

            $question4 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the following picture does not match?',
                'question_type' => 'text',
                //'question_image' => '/images/question/question-4-onzlah.png',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'A heart',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => '2 doves on a branch',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Hands touching each other',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Lions roaring at each other',
                'status' => 'correct',
            ]);

            //----q5

            $question5 = Question::create([
                'event_id' => $event->id,
                'question' => 'What did the actor say in the video?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'You love me',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'You protect me',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'You complete me',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'You love me',
                'status' => 'wrong',
            ]);

            //----q6

            $question6 = Question::create([
                'event_id' => $event->id,
                'question' => 'Is the information stated true or false?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'True',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'False',
                'status' => 'wrong',
            ]);/*
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Kenny Rogers',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Bob Dylan',
                'status' => 'wrong',
            ]); */

            //----q7

            $question7 = Question::create([
                'event_id' => $event->id,
                'question' => 'In our Malaysian flag, which color starts first on the stripes?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Red',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'White',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Blue',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Yellow',
                'status' => 'wrong',
            ]);

            //----q8

            $question8 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the following about Malaysia is wrong?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Singapore was a part of Malaysia',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => "Mulu National Park is World's Largest Cave Chamber",
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => "The World's Largest Rubber Producer",
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Malaysia is 329,847 km squared',
                'status' => 'wrong',
            ]);

        } else if ($request->set == 'wednesday') {

            //------------------------------------------------------------------qset 3 wednesday
            //----q1

            $question1 = Question::create([
                'event_id' => $event->id,
                'question' => '"Just Keep Swimming" was the famous line said in Finding Nemo. What year was this movie released?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => '1893',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => '2003',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => '2020',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => '2021',
                'status' => 'wrong',
            ]);

            //----q2

            $question2 = Question::create([
                'event_id' => $event->id,
                'question' => 'What is the most used hashtag?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '#photooftheday',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '#picoftheday',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '#instagood',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '#kitajagakita',
                'status' => 'wrong',
            ]);

            //----q3

            $question3 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the following statement is true?',
                'question_type' => 'text',
                //'question_image' => 'http://www.cutecatgifs.com/wp-content/uploads/2014/08/trdmll.gif',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Parasite won 4 Oscars in 2019',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Joker won 4 Oscars in 2019',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Toy Story won 4 Oscars in 2019',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Once Upon A TIme In Hollywood won 4 Oscars in 2019',
                'status' => 'wrong',
            ]);

            //----q4

            $question4 = Question::create([
                'event_id' => $event->id,
                'question' => 'Can you find the word in the picture?',
                'question_type' => 'text',
                //'question_image' => '/images/question/question-4-onzlah.png',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Menang',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Senang',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Active',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Onzlah',
                'status' => 'wrong',
            ]);

            //----q5

            $question5 = Question::create([
                'event_id' => $event->id,
                'question' => 'How many dolphins did you see?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'One',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Three',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Five',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'None',
                'status' => 'wrong',
            ]);

            //----q6

            $question6 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the below is true?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Nicolas Cage is married to a fan',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Yuna & Adam Sinclair is together',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Jenn Chia & Jon Lidell is together',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'All of the above',
                'status' => 'correct',
            ]);

            //----q7

            $question7 = Question::create([
                'event_id' => $event->id,
                'question' => 'Animals do not fight to the death. So which of the following is true?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'They fight becasue of food only',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'They fight for mating rights',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'They fight for territorial rights',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'All of the above',
                'status' => 'correct',
            ]);

            //----q8

            $question8 = Question::create([
                'event_id' => $event->id,
                'question' => 'Fun fact that blows your mind: Which of the following is wrong?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'There are more than 15,000 species of dragonflies',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Cockroaches have existed for over 500 million years',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Snails have ears',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'There is Ginseng in Ryo shampoo ',
                'status' => 'correct',
            ]);
        } else if ($request->set == 'thursday') {

            //------------------------------------------------------------------qset 4 is for thursday
            //----q1

            $question1 = Question::create([
                'event_id' => $event->id,
                'question' => " What was the model name of Arnold's character in the first Terminator?",
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Model 101 ',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Model T-2021',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'C3P0',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'R2D2',
                'status' => 'wrong',
            ]);

            //----q2

            $question2 = Question::create([
                'event_id' => $event->id,
                'question' => 'My Instagram handle is @SeanTheMan, tell me if it is true or false?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => 'True',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => 'False',
                'status' => 'wrong',
            ]);/*
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '#bolih',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => '#gameplay',
                'status' => 'wrong',
            ]); */

            //----q3

            $question3 = Question::create([
                'event_id' => $event->id,
                'question' => 'Trusting your intuition is the ultimate act of trusting yourself. True or false?',
                'question_type' => 'text',
                //'question_image' => 'http://www.cutecatgifs.com/wp-content/uploads/2014/08/trdmll.gif',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'True',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'False',
                'status' => 'wrong',
            ]);/*
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Toy Story won 4 Oscars in 2019',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Once Upon A TIme In Hollywood won 4 Oscars in 2019',
                'status' => 'correct',
            ]); */

            //----q4

            $question4 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the picture is the odd one out? ',
                'question_type' => 'text',
                //'question_image' => '/images/question/question-4-onzlah.png',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Blonde hair',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Black hair',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'RYO shampoo',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Red Ferrari',
                'status' => 'correct',
            ]);

            //----q5

            $question5 = Question::create([
                'event_id' => $event->id,
                'question' => 'Who is the singer in the video clip?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Justin Bieber',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Justin Timberlake',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Tobias "Toby" Sheldon',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Nick Jonas',
                'status' => 'wrong',
            ]);

            //----q6

            $question6 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which song made Mariah Carey earn up to USD 60 million?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'All I Want for Christmas Is You',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Hero',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'When You Believe',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Fantasy',
                'status' => 'wrong',
            ]);

            //----q7

            $question7 = Question::create([
                'event_id' => $event->id,
                'question' => 'What is the deadliest animal on earth?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Crocodiles – 1,000 deaths a year',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Lions – over 22 deaths a year',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Sharks – six deaths a year',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Tapeworms – 7,000 deaths a year',
                'status' => 'wrong',
            ]);

            //----q8

            $question8 = Question::create([
                'event_id' => $event->id,
                'question' => 'Caesar salad is originated from Mexico. True or false?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'True',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'False',
                'status' => 'wrong',
            ]);/*
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Snails have ears, so they can hear',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'in the RYO shampoo, there is ginseng ',
                'status' => 'correct',
            ]); */

        } else if ($request->set == 'friday') {

            //------------------------------------------------------------------qset 4
            //----q1

            $question1 = Question::create([
                'event_id' => $event->id,
                'question' => 'Who said the line "Do I feel lucky?" in the film called Dirty Harry ',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Mel Gibson',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Clint Eastwood',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Morgan Freeman',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question1->id,
                'answer' => 'Timothy Dalton',
                'status' => 'wrong',
            ]);

            //----q2

            $question2 = Question::create([
                'event_id' => $event->id,
                'question' => 'If Youtube has the highest, which of the following comes after?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => 'LinkedIn',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => 'Facebook',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => 'Twitter',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question2->id,
                'answer' => 'Google',
                'status' => 'correct',
            ]);

            //----q3

            $question3 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which movie said this “I want my best friend back because I’m in love with her”?',
                'question_type' => 'text',
                //'question_image' => 'http://www.cutecatgifs.com/wp-content/uploads/2014/08/trdmll.gif',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Just Friends ',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Friends with Benefits',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Brides Maids',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question3->id,
                'answer' => 'Pitch Perfect',
                'status' => 'wrong',
            ]);

            //----q4

            $question4 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the following picture is true?',
                'question_type' => 'text',
                //'question_image' => '/images/question/question-4-onzlah.png',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Leonardo DiCaprio & Tobey Maguire',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Cameron Diaz & Drew Barrymore',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'Tom Cruise & Jerry Seinfeld',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question4->id,
                'answer' => 'All of the above',
                'status' => 'correct',
            ]);

            //----q5

            $question5 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which movie featured Love Is All Around by Wet Wet Wet as the soundtrack?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Miss Congeniality 1',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Four Weddings & A Funeral',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Miss Congeniality 2',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question5->id,
                'answer' => 'Way Back Into Love',
                'status' => 'wrong',
            ]);

            //----q6

            $question6 = Question::create([
                'event_id' => $event->id,
                'question' => 'What is the title of the song that made her a household name?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Koleksi Gemilang',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Jagalah Diri',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Sinaran',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question6->id,
                'answer' => 'Gemilang',
                'status' => 'correct',
            ]);

            //----q7

            $question7 = Question::create([
                'event_id' => $event->id,
                'question' => 'Which of the below is the most relevant about Best Friends Forever?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Never ignore your text',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Goes shopping with you',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Buys you birthday presents',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question7->id,
                'answer' => 'Calls you when they need you.',
                'status' => 'wrong',
            ]);

            //----q8

            $question8 = Question::create([
                'event_id' => $event->id,
                'question' => 'Fun fact that blows your mind: which of the following is wrong?',
                'question_type' => 'text',
                'fired' => 'false',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'There are over 30,000 known species of fish',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Tuna cannot swim at the speed of up to 70kph (43mph)',
                'status' => 'correct',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'There are over 500 million domestic cats in the world',
                'status' => 'wrong',
            ]);
            Answer::create([
                'question_id' => $question8->id,
                'answer' => 'Cats conserve energy by sleeping for an average of 13-14 hours a day',
                'status' => 'wrong',
            ]);
        }
        return ['status' => 'good'];
    }
}
