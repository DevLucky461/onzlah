<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Events\ChatEvent;
use App\Message;
use App\User;

class ChatController extends Controller
{
    public function sendMessage(Request $request)
    {
        //dd($request->all());

        $message = Message::create([
            "user_id" => Auth::id(),
            "message" => $request->message,
            "video_id" => $request->video_id
        ]);


        $sender = User::where("id", Auth::id())->first();

        $data = [];
        $data["user_id"] = Auth::id();
        $data["sender_name"] = $sender->name;
        //$data["user_id"] = $sender->name;
        $data["message"] = $message->message;
        $data["stream_id"] = $message->video_id;
        $data["created_at"] = $message->created_at;

        //dd($data);

        event(new ChatEvent($data));

        return response()->json(array("data" => $data));
    }
}
