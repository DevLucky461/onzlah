<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\feedback;

class FeedbackController extends Controller
{
    public function index()
    {
        return view('feedback');
    }

    public function create(Request $request)
    {
        //dd($request->all());

        feedback::create([
            "user_id" => Auth::id(),
            "exp" => $request->q1,
            "rating" => $request->q2,
            "frequency" => $request->q3,
            "recommend" => $request->q4,
            "comment" => $request->q5
        ]);

        return redirect()->back()->with("created", "success");
    }
}
