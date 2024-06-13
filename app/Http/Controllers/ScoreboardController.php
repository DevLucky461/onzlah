<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Friend;
use App\User;


class ScoreboardController extends Controller
{
    public function view()
    {

        $friends = User::where('id', auth()->id())->with('friends')->first();
        $friendlist = collect();
        foreach ($friends->friends as $friend) {
            $friendlist->push(User::where('id', $friend->friend_id)->first());
        }

        $alllist = User::all()->sortByDesc('coins')->take(10);

        return view('scoreboard', compact('friendlist', 'alllist'));
    }
}
