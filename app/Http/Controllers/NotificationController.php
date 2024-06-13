<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Notification;
use App\NotificationSettings;
use Carbon\Carbon;

class NotificationController extends Controller
{
    public function index()
    {
        $noti = Notification::where(['user_id' => Auth::id(), "type" => "in_app"])->orderBy('created_at', 'desc')->get();
        $notiArray = [];

        foreach ($noti as $n) {
            //dd($n->created_at->diffForHumans(Carbon::now()));
            $notiArray[] = ["id" => $n->id, "notification" => $n->notification, "time_difference" => ($n->created_at->diffForHumans(Carbon::now())), "status" => $n->status];
        }
        // /dd($notiArray);

        return view('notification', compact('notiArray'));
    }

    public function view_settings()
    {

        $noti = NotificationSettings::where(["user_id" => Auth::id()])->get();
        //dd($noti);
        return view('notification_settings', compact('noti'));
    }

    public function update(Request $request)
    {

        Notification::where('id', $request->id)->update([
            "status" => "read",
        ]);

        return response()->json(array("data", "notification status update"));
    }

    public function update_notification_setting(Request $request)
    {


        if ($request->type == "email") {
            if ($request->status == "true") {
                NotificationSettings::where(["user_id" => Auth::id(), "setting" => $request->setting])
                    ->update(["email" => "true"]);

                return ["success"];
            }
            if ($request->status == "false") {
                NotificationSettings::where(["user_id" => Auth::id(), "setting" => $request->setting])
                    ->update([
                        "email" => "false",
                    ]);

                return ["success"];
            }
        }

        if ($request->type == "in_app") {

            if ($request->status == "true") {

                NotificationSettings::where(["user_id" => Auth::id(), "setting" => $request->setting])
                    ->update([
                        "in_app" => "true",
                    ]);

                return ["success"];
            }
            if ($request->status == "false") {

                NotificationSettings::where(["user_id" => Auth::id(), "setting" => $request->setting])
                    ->update([
                        "in_app" => "false",
                    ]);

                return ["success"];
            }
        }

    }
}
