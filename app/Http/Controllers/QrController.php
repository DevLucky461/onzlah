<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Friend;
use App\NotificationSettings;


class QrController extends Controller
{
    public function index()
    {
        return view('qr');
    }

    public function add_friend($id)
    {
        if (Auth::check()) {
            if ($id == Auth::id()) {
                return redirect('/qr')->with('error', 'You cannot be friends with yourself :(');
            } else {
                //$usernoti = NotificationSettings::where(["user_id" => Auth::id(), "type" => "Your friend request approved"])->first();
                $friend = User::where("id", $id)->first();
                $check = Friend::where(["user_id" => $id, "friend_id" => Auth::id()])->first();
                $check_friend = Friend::where(["user_id" => Auth::id(), "friend_id" => $id])->first();
                //dd(empty($check) , empty($check_friend));
                if (empty($check) && empty($check_friend)) {
                    Friend::create([
                        "user_id" => $id,
                        "friend_id" => Auth::id(),
                        "status" => "approved",
                    ]);
                    Friend::create([
                        "user_id" => Auth::id(),
                        "friend_id" => $id,
                        "status" => "approved",
                    ]);
                    return redirect('/qr')->with('success', 'You are now friends with ' . $friend->name . '!');
                } else {
                    return redirect('/qr')->with('error', 'Both of you are already friends :)');
                }
            }
        } else {
            return redirect('/qr')->with('error', 'You are not logged in!');
        }
    }
}
