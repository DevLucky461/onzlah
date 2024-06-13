<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Event;
use App\Question;
use App\User_Event;
use App\User_Question;
use App\Answer;
use App\User;
use App\QuestionOrder as Order;

class QuestionController extends Controller
{
    public function view()
    {

        $event = Event::where('id', 1)->with(['question' => function ($q) {
            $q->orderBy('id');
        }])->first(); //change on production
        return view('questions.question-test', compact('event'));
    }

    public function getEvent(Request $request)
    {
        return [
            Event::where('id', $request->event_id)->with(['question' => function ($q) {
                $q->orderBy('id');
            }])->first(),
        ];
    }

    public function fireQuestion(Request $request)
    {
        //dd([$request->question_id, $request->event_id]);
        $question = Question::where('id', $request->question_id)->first()->update([
            'fired' => 'true',
        ]);

        $event = Event::where('id', $request->event_id)->first()->update([
            'question_state' => $request->question_id,
        ]);

        if (Order::where('event_id', $request->event_id)->get()->isNotEmpty()) {
            $prevorder = Order::where('event_id', $request->event_id)->get()->sortByDesc('order')->first()->order;
            Order::create([
                'event_id' => $request->event_id,
                'question_id' => $request->question_id,
                'order' => $prevorder + 1,
            ]);
            return ['success' => 'true'];
        } else {
            Order::create([
                'event_id' => $request->event_id,
                'question_id' => $request->question_id,
                'order' => 1,
            ]);
            return ['success' => 'true'];
        }
        return ['success' => 'false'];
    }

    public function fireScoreboard(Request $request)
    {
        $event = Event::where('id', $request->event_id)->first();
        $winners = User_Event::where([
            'order' => 8,
            'user_status' => 'pass',
        ])->with('user')->get();
        if ($winners->count() != 0) {
            $prize_amt = number_format($event->event_coins_prize_pool / $winners->count(), 0, '.', '');
        } else $prize_amt = -1;
        foreach ($winners as $w) {
            $w->user->update([
                'coins' => $w->user->coins + $prize_amt,
            ]);
        }

        return [
            'message' => 'success',
            'user_id' => $winners->pluck('user')->pluck('id'),
            'winner_count' => $winners->count(),
            'prize_money' => $prize_amt,
        ];
    }

    public function scoreUpdate(Request $request)
    {
        $user_event = User_Event::where([   //get user status for current event
            'user_id' => $request->user_id,
            'event_id' => $request->event_id,
        ])->first();

        $answer_correct = \App\Question::where('id', $request->question_id)->with(['answer' => function ($query) {
            $query->where('status', 'correct')->first();
        }])->first();

        if ($request->answer_id != null) {
            $answer = Answer::where('id', $request->answer_id)->first(); //get request->answer from db
            $user_status;   //set pass or fail based on answer_status from db
            if ($answer->status == 'correct') $user_status = 'pass';
            else $user_status = 'fail';
        } else if ($request->answer_id == null && $user_event->user_status == 'fail') {    //if user didnt answer after he got 1 wrong, he's disqualified
            $user_event->update([
                'user_status' => 'disabled',
            ]);
            return [
                'user_status' => $user_event->user_status,
                'stats' => 'blocked',
                'life' => auth()->user()->life,
                'used_life' => $user_event->used_life,
                'correct_answer' => $answer_correct,
                'user_order' => $user_event->order,
            ];
        } else {
            $user_status = 'fail';
            $answer = ['status' => 'wrong'];
        }
        if ($request->answer_id != null) {
            $user_question = User_Question::create([    //create entry for each answered question for user
                'question_id' => $request->question_id,
                'user_id' => $request->user_id,
                'answer_id' => $request->answer_id,
                'status' => $answer['status'],
            ]);
        } else {
            $user_question = User_Question::create([    //create entry for each answered question for user
                'question_id' => $request->question_id,
                'user_id' => $request->user_id,
                'answer_id' => '0', //0 means unanswered
                'status' => $answer['status'],
            ]);
        }

        if ($user_event->user_status == 'disabled') $user_status = 'disabled';  //if user is disabled, overwrite any result and stay disabled
        if ($user_event) {    //if found, update the status based on answer
            $user_event->update([
                'user_status' => $user_status,
            ]);
        } else {
            $user_event = User_Event::create([  //if not found, create new entry
                'user_id' => $request->user_id,
                'event_id' => $request->event_id,
                'user_status' => $user_status,
            ]);
        }

        /* if(($user_event->user_status == 'pass' || $user_event->user_status == 'fail') && $user_event->order == '7'){    //if user made it to 7th question, right or wrong, gets extra life.
            $currentuser = User::where('id', $request->user_id)->first();
            $currentuser->update([
                'life' => $currentuser->life + 1,
            ]);
        } */

        return [
            'user_status' => $user_event->user_status,
            'stats' => $answer['status'],
            'life' => auth()->user()->life,
            'used_life' => $user_event->used_life,
            'correct_answer' => $answer_correct,
            'user_order' => $user_event->order,
        ];
    }

    public function useLife(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        $user->update([
            'life' => $user->life - 1,
        ]);
        $user_event = User_Event::where(['user_id' => $request->user_id, 'event_id' => $request->event_id])->first();
        $user_event->update([
            'user_status' => 'pass',
            'used_life' => $user_event->used_life + 1,
        ]);
        return ['success' => 'true', 'used_life' => $user_event->used_life, 'remaining_life' => $user->life];
    }

    public function getScorePercentage(Request $request)
    {
        $answers = \App\Answer::where('question_id', $request->question_id)->orderBy('id')->get()->pluck('id')->unique()->values()->all();
        $tally;
        for ($i = 0; $i < count($answers); $i++) {
            $tally[$i] = '0%';
        }
        $question = \App\User_Question::where(['question_id' => $request->question_id, ['answer_id', '!=', '0']])->orderBy('id')->get();
        for ($i = 0; $i < count($answers); $i++) {
            if ($question->isEmpty()) {
                $tally[$i] = "0%";
            } else {
                $tally[$i] = number_format($question->where('answer_id', $answers[$i])->count() / $question->count() * 100, 0) . "%";
            }
        }

        return ['percentage' => $tally];

    }

    public function scoreUpdateObserver(Request $request)
    {
        $answer_correct = \App\Question::where('id', $request->question_id)->with(['answer' => function ($query) {
            $query->where('status', 'correct')->first();
        }])->first();

        return [
            'correct_answer' => $answer_correct
        ];
    }

    public function testFunction()
    {
        //SELECT answer_id, count(user_id) FROM `user_question` where question_id = 2 group by answer_id --> use this for percentage calculation
    }
}
