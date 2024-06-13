<?php

namespace App\Http\Controllers;

use App\Event;
use App\Question;
use App\Answer;
use Illuminate\Http\Request;
use Illuminate\Http\File;

class EventController extends Controller
{
    public function index()
    {
        return view('admin.event');
    }

    public function view_list()
    {
        $event = Event::with('question')->get()->sortBy('created_at');
        return view('admin.event_list', compact('event'));
    }

    public function create_event(Request $request)
    {
        //dd($request->all());

        if ($request->hasFile('file_name')) {

            $image = $request->file('file_name');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/project_img');
            $image->move($destinationPath, $name);

            $event = Event::create([
                'event_name' => $request->event_name,
                'event_description' => $request->event_desc,
                'event_host_name' => $request->event_host,
                'event_start_date' => $request->start_date,
                'event_end_date' => $request->end_date,
                'event_coins_prize_pool' => $request->event_coins_prize,
                'event_image_url' => '/images/project_img/' . $name,
                'stream_key' => $request->stream_key,
                'question_state' => 0,
            ]);
        } else {
            $event = Event::create([
                'event_name' => $request->event_name,
                'event_description' => $request->event_desc,
                'event_host_name' => $request->event_host,
                'event_start_date' => $request->start_date,
                'event_end_date' => $request->end_date,
                'event_coins_prize_pool' => $request->event_coins_prize,
                //'event_image_url' => '/images/project_img/'.$name,
                'stream_key' => $request->stream_key,
                'question_state' => 0,
            ]);
        }

        return response()->json(array('message' => 'An event has been added!', 'event_id' => $event->id));
    }

    public function create_question(Request $request)
    {

        $question = Question::create([
            "question" => $request->question,
            "event_id" => $request->event_id,
            "fired" => "wrong"
        ]);

        $answer1 = Answer::create([
            "answer" => $request->answer1,
            "question_id" => $question->id,
            "status" => $request->answer_status_1,
        ]);

        $answer2 = Answer::create([
            "answer" => $request->answer2,
            "question_id" => $question->id,
            "status" => $request->answer_status_2,
        ]);

        $answer3 = Answer::create([
            "answer" => $request->answer3,
            "question_id" => $question->id,
            "status" => $request->answer_status_3,
        ]);

        $answer4 = Answer::create([
            "answer" => $request->answer4,
            "question_id" => $question->id,
            "status" => $request->answer_status_4,
        ]);

        return response()->json(array("question_success", "date"));
    }

    public function delete_event(Request $request)
    {
        $event = Event::where('id', $request->id)->first();
        $question = Question::where("event_id", $event->id)->get();

        if (!$question->isEmpty()) {
            foreach ($question as $q) {
                $answer = Answer::where("question_id", $q->id)->delete();
            }
            $question->delete();
        }

        $event->delete();
        return response()->json(array("event_deleted", "date"));
    }

    public function view_event($id)
    {
        $question = collect();
        $event = collect();
        $eventdata = Event::where('id', $id)->with('question')->first();

        $event = [
            "event_id" => $eventdata->id,
            "event_name" => $eventdata->event_name,
            "event_description" => $eventdata->event_description,
            "event_host_name" => $eventdata->event_host_name,
            "event_start_date" => $eventdata->event_start_date->toDateTimeLocalString(),
            "event_end_date" => $eventdata->event_end_date->toDateTimeLocalString(),
            "event_coins_prize_pool" => $eventdata->event_coins_prize_pool,
            "event_img" => $eventdata->event_image_url,
            "event_stream_key" => $eventdata->stream_key,
        ];

        foreach ($eventdata->question as $qu) {
            $question = Question::where('event_id', $qu->event_id)->with('answer')->get();
        }

        //dd( $event );
        return view('admin.event-edit', compact('event', 'question'));
    }

    public function event_save_details(Request $request)
    {
        //dd($request->all());

        $event = Event::where('id', $request->id)->first();
        if ($request->save_type == "details") {

            $event->update([
                'event_name' => $request->event_name,
                'event_description' => $request->event_desc,
                'event_host_name' => $request->event_host,
                'event_start_date' => $request->start_date,
                'event_end_date' => $request->end_date,
                'event_coins_prize_pool' => $request->event_coins_prize,
                'stream_key' => $request->stream_key,
                'question_state' => 0,
            ]);

            return response()->json(array("data" => "event updated sucessfully"));
        }

        if ($request->save_type == "image") {

            if (file_exists(public_path('images/project_img/' . $event->event_image_url))) {
                unlink(public_path('images/project_img/' . $event->event_image_url));
            }

            $image = $request->file('file_name');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('/images/project_img');
            $image->move($destinationPath, $name);

            $event->update([
                'event_image_url' => '/images/project_img/' . $name,
            ]);

            return response()->json(array("data" => "event image updated sucessfully"));
        }
    }

    public function event_save_question(Request $request)
    {

        //dd($request->all());

        $answerArray = explode(',', $request->answer);
        $answerstatusArray = explode(',', $request->answer_status);

        $question = Question::where('id', $request->question_id)->with('answer')->first();

        $question->update([
            "question" => $request->question
        ]);

        for ($i = 0; $i < $question->answer->count(); $i++) {
            $question->answer[$i]->update([
                "answer" => $answerArray[$i],
                "status" => $answerstatusArray[$i],
                "event_id" => $question->id,
            ]);
        }

        return response()->json(array("data" => "Question and Answer Updated"));
    }

    public function event_delete_question(Request $request)
    {
        //dd($request->all());
        $question = Question::where('id', $request->id)->with('answer')->first();

        foreach ($question->answer as $answer) {
            $answer = Answer::where('id', $answer->id)->delete();
        }

        $question->delete();

        return response()->json(array("data" => "Question deleted"));
    }

    public function event_create_question(Request $request)
    {

        //dd($request->all());

        $answerArray = explode(',', $request->answer);
        $answerstatusArray = explode(',', $request->answer_status);

        $question = Question::create([
            "question" => $request->question,
            "event_id" => $request->event_id,
            "fired" => "false",
        ]);

        for ($i = 0; $i < count($answerArray); $i++) {
            Answer::create([
                "answer" => $answerArray[$i],
                "status" => $answerstatusArray[$i],
                "question_id" => $question->id,
            ]);

        }

        return response()->json(array("data" => "Question Created"));
    }
}
