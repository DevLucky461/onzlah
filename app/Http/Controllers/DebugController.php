<?php

namespace App\Http\Controllers;

use App\Event;
use App\Question;
use App\QuestionOrder;
use App\User_Question;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User_Event;
use App\Answer;
use App\User;
use Illuminate\Support\Facades\Mail;
use App\Mail\PrelaunchMail;
use App\Mail\PreregisterMail;
use App\Mail\ApologyMail;
use Illuminate\Support\Facades\DB;
use App\UserReferral;
use App\Life_Transaction;
use App\Notification;
use App\NotificationSettings;
use Faker\Factory;
use Illuminate\Support\Facades\Hash;

class DebugController extends Controller
{
    //
    public function debug1()
    {
        $data = [
            'name' => 'chacha',
            'password' => '123456',
        ];

        return new ApologyMail($data);
        //Mail::to('candyleong@hotshoes.com.my')->send(new PrelaunchMail('123456'));
        //Mail::to('jerrytang@cakexp.com')->send(new PrelaunchMail('123456'));
        //Mail::to('ashaari.azman3142@gmail.com')->send(new PrelaunchMail('123456'));
        return 'ok';
    }

    public function debug_logout()
    {
        Auth::logout();
    }

    public function debug_unity()
    {
        $onzlah_user = User::all();

        return response()->json([
            'name' => 'Abigail',
            'state' => 'CA',
        ]);
    }

    public function resetPanel()
    {
        Question::where('fired', 'true')->update(['fired' => 'false']);
        Event::where('question_state', '!=', '0')->update(['question_state' => '0']);
        DB::table('user_event')->update([
            'user_status' => 'pass',
            'order' => '0',
            'used_life' => '0',
        ]);
        User_Question::truncate();
        QuestionOrder::truncate();
        return [
            'status' => 'success',
            'message' => 'Database refreshed',
        ];
    }

    public function viewHostPanel()
    {
        $event = Event::all()->sortBy('event_start_date')->first();
        $question = Question::where('event_id', $event->id)->orderBy('id')->with(['answer' => function ($query) {
            $query->orderBy('id');
        }])->first();
        $message = \App\Message::where('video_id', $event->id)->with('users')->get();
        return view('host-panel', compact(
            'event',
            'question',
            'message'
        ));
    }

    public function getQuestion(Request $request)
    {
        $question = Question::where('event_id', $request->event_id)->orderBy('id')->with(['answer' => function ($query) {
            $query->orderBy('id');
        }])->get();
        return ['question' => $question[$request->index]];
    }

    public function getRegisteredUser()
    {
        $users = collect();
        for ($i = 0; $i < 30; $i++) {
            $users->push(User::whereDate('created_at', today()->modify('-' . $i . ' day'))->get());
        }
        //dd($users[1]->count());
        $usercount = User::all()->count() - 60;
        return view('debug.registered-users', compact('users', 'usercount'));
    }

    public function apologyMail()
    {
        $maillist = [
            //"genie.leongaj@gmail.com",
            "haha61.hahaha@gmail.com",
            "lsf.olivia@gmail.com",
            "keam88@gmail.com",
            "tingting6g@gmail.com",
            "muzaffar95khan@gmail.com",
            "richletter@gmail.com",
            "lumshinwen@gmail.com",
            "ngpohbee@ktj.edu.my",
            "carolfoo@hotshoes.com.my",
            "bubblelzs@hotmail.com",
            "kaixiangpang11@gmail.com",
        ];
        $namelist = [
            //"genie.leongaj",
            "haha61.hahaha",
            "lsf.olivia",
            "keam88",
            "tingting6g",
            "muzaffar95khan",
            "richletter",
            "lumshinwen",
            "ngpohbee",
            "carolfoo",
            "bubblelzs",
            "kaixiangpang11",
        ];

        /* $maillist = [
            "ashaari.azman3142@gmail.com",
        ];
        $namelist = [
            "ashaari.azman3142",
        ]; */
        for ($i = 0; $i < 11; $i++) {
            if (User::where('email', $maillist[$i])->first() == null) {
                $pass = mt_rand(100000, 99999999);
                $user = User::create([
                    'name' => $namelist[$i],
                    'password' => Hash::make($pass),
                    'email' => $maillist[$i],
                    'phonenumber' => "0123456789" . $i,
                    'referral_code' => '#ONZ' . Factory::create()->unique()->passthrough(mt_rand(10000, 99999)),
                    'coins' => '0',
                    'life' => 3,
                    'verify' => 'yes',
                    'email_verified_at' => now(),
                    'verificationcode' => mt_rand(100000, 999999)
                ]);
                $user->update([
                    'picture' => 'images/default-picture/' . strtolower($user->name[0]) . '.png'
                ]);
                //dd($user->id);

                NotificationSettings::create([
                    "user_id" => $user->id,
                    "setting" => "Update latest news",
                    "email" => "true",
                    "in_app" => "true",
                ]);

                NotificationSettings::create([
                    "user_id" => $user->id,
                    "setting" => "New items to redeem",
                    "email" => "true",
                    "in_app" => "true",
                ]);

                NotificationSettings::create([
                    "user_id" => $user->id,
                    "setting" => "Update Live schedule",
                    "email" => "true",
                    "in_app" => "true",
                ]);


                NotificationSettings::create([
                    "user_id" => $user->id,
                    "setting" => "Before Live start",
                    "email" => "true",
                    "in_app" => "true",
                ]);

                NotificationSettings::create([
                    "user_id" => $user->id,
                    "setting" => "Coins you’ve won",
                    "email" => "true",
                    "in_app" => "true",
                ]);


                NotificationSettings::create([
                    "user_id" => $user->id,
                    "setting" => "Friend request",
                    "email" => "true",
                    "in_app" => "true",
                ]);

                NotificationSettings::create([
                    "user_id" => $user->id,
                    "setting" => "Your friend request approved",
                    "email" => "true",
                    "in_app" => "true",
                ]);

                NotificationSettings::create([
                    "user_id" => $user->id,
                    "setting" => "Referral code has been used",
                    "email" => "true",
                    "in_app" => "true",
                ]);
                $data = [
                    'name' => $namelist[$i],
                    'password' => $pass,
                ];

                Mail::to($maillist[$i])->send(new ApologyMail($data));
            }
        }
    }
}
