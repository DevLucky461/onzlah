<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Banner;
use App\Event;
use Carbon\Carbon;
use App\Notification;

class MainController extends Controller
{

    public function view()
    {
        $banner = Banner::get()->take(5);
        $event = Event::where('event_end_date', '>', now())->paginate(4);
        $noti = Notification::where(["user_id" => Auth::id(), "status" => "unread"])->count();
        $i = 0;

        return view('main', compact(
            'banner',
            'event',
            'i',
            'noti'
        ));
    }
}
