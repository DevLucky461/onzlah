<?php

namespace App\Http\Controllers\Mobile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\User;
use App\User_Event;
use App\Event;
use App\Sticker;
use App\Question;
use App\User_Question;
use App\Answer;
use App\Message;
use App\Sticker_State;
use App\Transaction;
use App\QuestionOrder as Order;
use Illuminate\Support\Str;
use App\Events\ChatEvent;

class LiveController extends Controller
{
    //

    public function liveInit()
    {
        $user = JWTAuth::parseToken()->authenticate();
        //$user = User::where('id', 1)->first();
        //$user = auth()->user();
        //dd($user);
        $event = Event::all()->sortBy('event_start_date')->first(); //change on production

        $order = Order::where('event_id', $event->id)->get();
        $user_event = User_Event::where([
            'user_id' => $user->id,
            'event_id' => $event->id,
        ])->first();

        if ($order->isEmpty() && !$user_event) {  //if no question fired, no need to check further.
            $user_event = User_Event::create([
                'user_id' => $user->id,
                'event_id' => $event->id,
                'user_status' => 'pass',
                'order' => '0',
            ]);
        } else if ($order->isNotEmpty()) {  //if got question fired, check if its the first or not
            $latest = $order->sortByDesc('order')->first();
            if (!$user_event) {
                if ($latest->order == 1 && now()->diffInSeconds($latest->updated_at) < 16) {  //if its the first, check if atleast 16 seconds has elapsed. if not, give pass
                    $user_event = User_Event::create([
                        'user_id' => $user->id,
                        'event_id' => $event->id,
                        'user_status' => 'pass',
                        'order' => '1',
                    ]);
                } else if ($latest->order > 1) {    //if its not the first question and user does not exist, straight disable him
                    $user_event = User_Event::create([
                        'user_id' => $user->id,
                        'event_id' => $event->id,
                        'user_status' => 'disabled',
                        'order' => $order->sortByDesc('order')->first()->order,
                    ]);
                }
            } else if ($user_event && $user_event->status != 'disabled') { //if user already exist and not disabled but question order differ by more than +1, disable him
                if (!($user_event->order == $latest->order || ($user_event->order - 1 == $latest->order && now()->diffInSeconds($latest->updated_at) < 16))) {
                    $user_event->update([
                        'user_status' => 'disabled',
                    ]);
                }
            }
        }

        // finish init user status, begin init page data
        $sticker = Sticker::all();  //data for sticker sets
        $stickercount = Sticker_State::where('event_id', $event->id)->get()->pluck('quantity')->sum(); //init data for current sticker count
        $message = Message::where('video_id', $event->id)->with('users')->get();    //init data for current stored message
        $currentquestion = Question::where('id', $event->question_state)->with('answer')->first();  //init data for currently fired question

        return response()->json([
            "currentuser" => $user,
            "event" => $event,
            "sticker" => $sticker,
            "stickercount" => $stickercount,
            "message" => $message,
            "currentquestion" => $currentquestion,
        ]);
    }


    public function stickerUpdate(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        //$user = User::where('id', 1);
        $sticker_state = Sticker_State::where([
            'event_id' => $request->event_id,
            'sticker_id' => $request->sticker_id,
        ])->first();

        $sticker_state->update([
            'quantity' => $sticker_state->quantity + 1,
        ]);

        $transaction = Transaction::create([
            'transaction_type' => 'purchased_sticker',
            'transaction_value' => '-' . Sticker::where('id', $request->sticker_id)->first()->sticker_cost,
            'user_id' => $user->id,
        ]);

        $user->update([
            'coins' => $user->coins + $transaction->transaction_value,
        ]);


        return response()->json([
            "usercoin" => $user->coins,
        ]);
    }

    public function sendMessage(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        $message = Message::create([
            "user_id" => $user->id,
            "message" => $request->message,
            "video_id" => $request->video_id
        ]);

        $sender = User::where("id", $user->id)->first();

        $data = [];
        $data["user_id"] = $user->id;
        $data["sender_name"] = $sender->name;
        $data["message"] = $message->message;
        $data["stream_id"] = $message->video_id;
        $data["created_at"] = $message->created_at;

        event(new ChatEvent($data));

        return response()->json(array("data" => $data));
    }

    public function quizState(Request $request)
    {    //event_id
        $user = JWTAuth::parseToken()->authenticate();
        $event = Event::where('id', $request->event_id)->with('question')->first();
        $order = Order::where(['question_id' => $event->question_state, 'event_id' => $event->id])->first();
        $user_event = User_Event::where([
            'user_id' => $user->id,
            'event_id' => $request->event_id,
        ])->first();

        if ($event->question_state > 0 && now()->diffInSeconds($event->updated_at) < 16) {
            $question = Question::where('id', $event->question_state)->with(['answer' => function ($query) {
                $query->orderBy('id');
            }])->first();
            $image_list = Str::of($question->question_image)->explode(',');
            $user_event->update(['order' => $order->order]);
            return response()->json([
                'status' => $user_event->user_status,
                'question' => $question,
                'currenttime' => now()->modify('-16 seconds')->diffInSeconds($event->updated_at),
                'used_life' => $user_event->used_life,
                'order' => $order->order,
                'image_list' => $image_list,
            ]);
        } else if ($event->question_state == -1) {
            $winner = User_Event::where('user_status', 'pass')->with('user')->get();
            if ($winner->count() != 0) {
                return response()->json([
                    'status' => 'SCOREBOARD',
                    'winner' => $winner,
                    'prize' => $event->event_coins_prize_pool / $winner->count(),
                    'used_life' => $user_event->used_life,
                ]);
            } else return response()->json([
                'status' => 'NO WINNER',
            ]);
        } else return response()->json([
            'status' => 'ERROR',
            'question' => null,
            'currenttime' => 'ended',
            'timediff' => now()->diffInSeconds($event->updated_at),
        ]);
    }

    public function scoreUpdate(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user_event = User_Event::where([   //get user status for current event
            'user_id' => $user->id,
            'event_id' => $request->event_id,
        ])->first();

        $answer_correct = \App\Question::where('id', $request->question_id)->with(['answer' => function ($query) {
            $query->where('status', 'correct')->first();
        }])->first();

        if ($request->answer_id != null) {
            $answer = Answer::where('id', $request->answer_id)->first(); //get request->answer from db
            $user_status = null;   //set pass or fail based on answer_status from db
            if ($answer->status == 'correct') $user_status = 'pass';
            else $user_status = 'fail';
        } else if ($request->answer_id == null && $user_event->user_status == 'fail') {    //if user didnt answer after he got 1 wrong, he's disqualified
            $user_event->update([
                'user_status' => 'disabled',
            ]);
            return [
                'user_status' => $user_event->user_status,
                'stats' => 'blocked',
                'life' => $user->life,
                'used_life' => $user_event->used_life,
                'correct_answer' => $answer_correct
            ];
        } else {
            $user_status = 'fail';
            $answer = ['status' => 'wrong'];
        }
        if ($request->answer_id != null) {
            $user_question = User_Question::create([    //create entry for each answered question for user
                'question_id' => $request->question_id,
                'user_id' => $user->id,
                'answer_id' => $request->answer_id,
                'status' => $answer['status'],
            ]);
        } else {
            $user_question = User_Question::create([    //create entry for each answered question for user
                'question_id' => $request->question_id,
                'user_id' => $user->id,
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
                'user_id' => $user->id,
                'event_id' => $request->event_id,
                'user_status' => $user_status,
            ]);
        }

        if (($user_event->user_status == 'pass' || $user_event->user_status == 'fail') && $user_event->order == '7') {    //if user made it to 7th question, right or wrong, gets extra life.
            $currentuser = User::where('id', $user->id)->first();
            $currentuser->update([
                'life' => $currentuser->life + 1,
            ]);
        }

        return [
            'user_status' => $user_event->user_status,
            'stats' => $answer['status'],
            'life' => $user->life,
            'used_life' => $user_event->used_life,
            'correct_answer' => $answer_correct
        ];
    }

    public function useLife(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->update([
            'life' => $user->life - 1,
        ]);
        $user_event = User_Event::where(['user_id' => $user->id, 'event_id' => $request->event_id])->first();
        $user_event->update([
            'user_status' => 'pass',
            'used_life' => $user_event->used_life + 1,
        ]);
        return response()->json([
            'success' => 'true',
            'used_life' => $user_event->used_life
        ]);
    }

    public function getScorePercentage(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();
        $answers = Answer::where('question_id', $request->question_id)->orderBy('id')->get()->pluck('id')->unique()->values()->all();
        $tally = null;
        for ($i = 0; $i < count($answers); $i++) {
            $tally[$i] = '0%';
        }
        $question = User_Question::where(['question_id' => $request->question_id, ['answer_id', '!=', '0']])->orderBy('id')->get();
        for ($i = 0; $i < count($answers); $i++) {
            if ($question->isEmpty()) {
                $tally[$i] = "0%";
            } else {
                $tally[$i] = number_format($question->where('answer_id', $answers[$i])->count() / $question->count() * 100, 0) . "%";
            }
        }

        return ['percentage' => $tally];
    }
}
