<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Contracts\Routing\ResponseFactory;
use App\Event;
use App\Sticker;
use App\Question;
use App\User_Event;
use App\Message;
use App\QuestionOrder as Order;
use Illuminate\Support\Str;

class StreamController extends Controller
{
    public function viewLivestage()
    {    //unused module
        $events = Event::where('event_end_date', '>', now())
            //->where('event_start_date', '<=', now()) //disabled for testing purpose. ENABLE WHEN IN PROD
            ->get();
        return view('livestage', compact('events'));
    }

    public function viewStream()
    {
        $event = Event::where('id', 13)->first(); //change on production
        $sticker = Sticker::all();
        $stickercount = \App\Sticker_State::where('event_id', $event->id)->get()->pluck('quantity');
        $message = Message::where('video_id', $event->id)->select('id', 'message', 'user_id')->latest()->with('users')->take(50)->get();
        $message = $message->reverse();
        $currentquestion = Question::where('id', $event->question_state)->with('answer')->first();

        return response()
            ->view('videopage', compact(
                'event',
                'sticker',
                'stickercount',
                'message',
                'currentquestion',
            ))
            ->header("Cache-Control", "no-cache,no-store, must-revalidate")
            ->header("Pragma", "no-cache")//HTTP 1.0
            ->header("Expires", " Sat, 26 Jul 1997 05:00:00 GMT");// Date in the past
    }

    public function viewObserver()
    {
        $event = Event::all()->sortBy('event_start_date')->first(); //change on production
        $sticker = Sticker::all();
        $stickercount = \App\Sticker_State::where('event_id', $event->id)->get()->pluck('quantity');
        $message = Message::where('video_id', $event->id)->with('users')->get();
        return view('observer', compact(
            'event',
            'sticker',
            'stickercount',
            'message',
        ));
    }

    public function initState(Request $request)
    {
        $order = Order::where('event_id', $request->event_id)->get();
        $user_event = User_Event::where([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
        ])->first();

        if ($order->isEmpty() && !$user_event) {  //if no question fired, no need to check further.
            $user_event = User_Event::create([
                'user_id' => auth()->id(),
                'event_id' => $request->event_id,
                'user_status' => 'pass',
                'order' => '0',
            ]);
        } else if ($order->isNotEmpty()) {  //if got question fired, check if its the first or not
            $latest = $order->sortByDesc('order')->first();
            if (!$user_event) {
                if ($latest->order == 1 && now()->diffInSeconds($latest->updated_at) < 16) {  //if its the first, check if atleast 16 seconds has elapsed. if not, give pass
                    $user_event = User_Event::create([
                        'user_id' => auth()->id(),
                        'event_id' => $request->event_id,
                        'user_status' => 'pass',
                        'order' => '1',
                    ]);
                } else if ($latest->order > 1) {    //if its not the first question and user does not exist, straight disable him
                    $user_event = User_Event::create([
                        'user_id' => auth()->id(),
                        'event_id' => $request->event_id,
                        'user_status' => 'disabled',
                        'order' => $order->sortByDesc('order')->first()->order,
                    ]);
                }
            } else if ($user_event && $user_event->status != 'disabled') {
                if (!($user_event->order == $latest->order || ($user_event->order - 1 == $latest->order && now()->diffInSeconds($latest->updated_at) < 16))) {
                    $user_event->update([
                        'user_status' => 'disabled',
                    ]);
                }
            }
        }
        return ['succes' => 'true'];
    }

    public function quizState(Request $request)
    {    //event_id
        $event = Event::where('id', $request->event_id)->with('question')->first();
        $order = Order::where(['question_id' => $event->question_state, 'event_id' => $event->id])->first();
        $user_event = User_Event::where([
            'user_id' => auth()->id(),
            'event_id' => $request->event_id,
        ])->first();

        if ($event->question_state > 0 && now()->diffInSeconds($event->updated_at) < 16) {
            $question = Question::where('id', $event->question_state)->with(['answer' => function ($query) {
                $query->orderBy('id');
            }])->first();
            $image_list = Str::of($question->question_image)->explode(',');
            $user_event->update(['order' => $order->order]);
            return [
                'status' => $user_event->user_status,
                'question' => $question,
                'currenttime' => now()->modify('-16 seconds')->diffInSeconds($event->updated_at),
                'used_life' => $user_event->used_life,
                'order' => $order->order,
                'image_list' => $image_list,
            ];
        } else if ($event->question_state == -1) {
            $winner = User_Event::where('user_status', 'pass')->with('user')->get();
            if ($winner->count() != 0) {
                return [
                    'status' => 'SCOREBOARD',
                    'winner' => $winner,
                    'prize' => $event->event_coins_prize_pool / $winner->count(),
                    'used_life' => $user_event->used_life,
                ];
            } else return [
                'status' => 'NO WINNER',
            ];
        } else return [
            'status' => 'ERROR',
            'question' => null,
            'currenttime' => 'ended',
            'timediff' => now()->diffInSeconds($event->updated_at),
        ];
    }


    public function quizStateObserver(Request $request)
    {    //event_id
        $event = Event::where('id', $request->event_id)->with('question')->first();
        $order = Order::where(['question_id' => $event->question_state, 'event_id' => $event->id])->first();
        $question = Question::where('id', $event->question_state)->with(['answer' => function ($query) {
            $query->orderBy('id');
        }])->first();

        if ($event->question_state > 0 && now()->diffInSeconds($event->updated_at) < 16) {
            $image_list = Str::of($question->question_image)->explode(',');
            return [
                'question' => $question,
                'currenttime' => now()->modify('-16 seconds')->diffInSeconds($event->updated_at),
                'order' => $order->order,
                'image_list' => $image_list,
            ];
        } else if ($event->question_state == -1) {
            $winner = User_Event::where('user_status', 'pass')->with('user')->get();
            if ($winner->count() != 0) {
                return [
                    'status' => 'SCOREBOARD',
                    'winner' => $winner,
                    'prize' => $event->event_coins_prize_pool / $winner->count(),
                    'used_life' => $user_event->used_life,
                ];
            } else return [
                'status' => 'NO WINNER',
            ];
        } else return [
            'status' => 'EMPTY',
            'question' => $question,
            'currenttime' => 'ended',
            'timediff' => now()->diffInSeconds($event->updated_at),
        ];
    }

    public function getWinnerList()
    {

        $winners = \App\User_Event::where([
            'order' => 8,
            'user_status' => 'pass',
        ])->with('user')->get();

        if ($winners->count() != 0) {
            return ['list' => $winners->pluck('user')->pluck('name')];
        } else return ['list' => 'none'];
    }
}
