<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\File;
use App\User;
use App\Friend;
use App\UserReferral;
use App\Notification;
use App\NotificationSettings;

class ProfileController extends Controller
{
    public function view()
    {
        return view('profile');
    }

    public function viewEdit($id)
    {
        $user = User::where('id', $id)->first();
        //dd($user->fullname == "null");
        //$userdob = str_replace(" ", "T",  $user->dateofbirth);
        return view('profile-edit', compact('user'));
    }

    public function view_qr()
    {

        \QrCode::size(300)->generate(\URL::to('/scan/' . Auth::id()));

        return view('my-qr');
    }

    public function edit(Request $request)
    {
        // update new data with post create
        return view('profile-edit' . $request->id)->with('message', 'Profile Updated!');
    }

    public function viewRecords()
    {
        return view('my-records');
    }

    public function viewFriends()
    {
        $friends = User::where('id', auth()->id())->with('friends')->first();
        $friendlist = collect();
        $unapprove = [];

        foreach ($friends->friends as $friend) {

            if ($friend->status == "approved") {
                $friendlist->push(User::where('id', $friend->friend_id)->first());
            };

            if ($friend->status == "unapproved") {
                $unapprove[] = ["user" => User::where('id', $friend->friend_id)->first(), "status" => "unapproved"];
            };

            if ($friend->status == "waiting") {
                $unapprove[] = ["user" => User::where('id', $friend->friend_id)->first(), "status" => "waiting"];
            }
        }

        //dd($unapprove);

        return view('my-friends', compact('friendlist', 'unapprove'));
    }

    public function viewReferral()
    {
        $referral = auth()->user()->referral_code;
        $userReferral = UserReferral::where("referral_id", auth()->id())->with("users")->get();
        $user = [];

        foreach ($userReferral as $items) {
            $user[] = ["name" => $items->users->name, "date" => $items->users->created_at->toFormattedDateString(), "coins" => "100"];
        }

        return view('my-referral', compact('referral', "user"));
    }

    public function viewHTP()
    {
        return view('how-to-play');
    }

    public function viewContact()
    {
        return view('contact-us');
    }

    public function viewFriendsProfile($id)
    {
        $user = User::where('id', $id)->first();
        //dd($user);
        return view('my-friends-profile', compact('user'));
    }

    public function viewFriendRequest()
    {
        // dd($friendlist);
        return view('my-friend-request');
    }

    public function viewFriendSearch()
    {
        return view('my-friends-search');
    }

    public function FriendRequest(Request $request)
    {

        Friend::where(["user_id" => $request->friend_id, "friend_id" => Auth::id()])->update([
            "status" => "approved",
        ]);

        Friend::where(["user_id" => Auth::id(), "friend_id" => $request->friend_id])->update([
            "status" => "approved",
        ]);


        $notisetting = NotificationSettings::where(["user_id" => Auth::id(), "setting" => "Your friend request approved"])->first();

        $friendsetting = NotificationSettings::where(["user_id" => $request->friend_id, "setting" => "Your friend request has been approved."])->first();

        if ($notisetting->email == "true") {

            Notification::create([
                "user_id" => Auth::id(),
                "notification" => "You have acceptted a friend request from " . User::where('id', $request->friend_id)->first()->name . '.',
                "type" => "email",
                "status" => "dispatch"
            ]);
        }

        if ($friendsetting->email == "true") {

            Notification::create([
                "user_id" => $request->addfriend,
                "notification" => User::where('id', Auth::id())->first()->name . " has accepted your friend request.",
                "type" => "email",
                "status" => "unsend"
            ]);
        }


        if ($notisetting->in_app == "true") {
            Notification::create([
                "user_id" => Auth::id(),
                "notification" => "You have accepted a friend request from " . User::where('id', $request->friend_id)->first()->name . '.',
                "type" => "in_app",
                "status" => "unsend"
            ]);
        }

        if ($friendsetting->in_app == "true") {
            Notification::create([
                "user_id" => $request->addfriend,
                "notification" => User::where('id', Auth::id())->first()->name . " has accepted your friend request.",
                "type" => "in_app",
                "status" => "unread"
            ]);
        }

        return response()->json(array("data" => 'You have approved the friend request.', "user" => User::where('id', $request->friend_id)->first()));
    }

    public function searchnewfriends(Request $request)
    {

        $search_user = [];
        $friendlist = [];

        $user = User::where('name', 'LIKE', '%' . $request->search_data . '%')->get();
        $friends = User::where('id', auth()->id())->with('friends')->first();


        foreach ($user as $us) {
            if ($us->name != User::where('id', Auth::id())->first()->name) {
                $search_user[] = $us->name;
            }

        }

        foreach ($friends->friends as $friend) {
            if ($friend->name != User::where('id', Auth::id())->first()->name) {
                $friendlist[] = (User::where('id', $friend->friend_id)->first()->name);
            }
        }

        $filter_user = array_diff($search_user, $friendlist);
        $user_collect = collect();
        //dd($search_user , $friendlist, $filter_user);

        foreach ($filter_user as $fu) {
            $user_collect->push(User::where('name', $fu)->first());
        }

        return response()->json(array("user" => $user_collect));
    }

    public function addNewFriends(Request $request)
    {
        //dd($request->all(), Auth::id());
        $friends = Friend::where(["user_id" => Auth::id(), "friend_id" => $request->friend_id])->first();
        $user = User::where('id', $request->friend_id)->first();

        if (!$friends) {
            Friend::create([
                "user_id" => $request->friend_id,
                "friend_id" => Auth::id(),
                "status" => "unapproved",
            ]);

            Friend::create([
                "user_id" => Auth::id(),
                "friend_id" => $request->friend_id,
                "status" => "waiting",
            ]);

            $notisetting = NotificationSettings::where(["user_id" => Auth::id(), "setting" => "Friend request"])->first();

            $friendsetting = NotificationSettings::where(["user_id" => $request->friend_id, "setting" => "Friend request"])->first();

            // dd($request->friend_id);

            if ($notisetting->email == "true") {
                Notification::create([
                    "user_id" => Auth::id(),
                    "notification" => "You have sent a friend request to " . User::where('id', $request->friend_id)->first()->name . '.',
                    "type" => "email",
                    "status" => "unsend"
                ]);
            }

            if ($notisetting->in_app == "true") {
                Notification::create([
                    "user_id" => Auth::id(),
                    "notification" => "You have sent a friend request to " . User::where('id', $request->friend_id)->first()->name . '.',
                    "type" => "in_app",
                    "status" => "unread"
                ]);
            }


            if ($friendsetting->email == "true") {
                Notification::create([
                    "user_id" => $request->friend_id,
                    "notification" => User::where('id', Auth::id())->first()->name . " has sent you a friend request.",
                    "type" => "email",
                    "status" => "unsend"
                ]);
            }


            if ($friendsetting->in_app == "true") {
                Notification::create([
                    "user_id" => $request->friend_id,
                    "notification" => User::where('id', Auth::id())->first()->name . " has sent you a friend request.",
                    "type" => "in_app",
                    "status" => "unread"
                ]);
            }

            return response()->json(array("message" => "waiting to be approved", "user" => $user = User::where('id', $request->friend_id)->first()));
        } else {
            return response()->json(array("message" => "Both of you are already friends!"));
        }
    }

    public function delete(Request $request)
    {
        // dd($request->all());
        $user = Friend::where(["user_id" => Auth::id(), "friend_id" => $request->id])->first();
        $friend = Friend::where(["user_id" => $request->id, "friend_id" => Auth::id()])->first();

        if ($user) {
            $user->delete();
            $friend->delete();

            return response()->json(array("user" => "Friend deleted successfully.", "id" => $request->id));
        } else {
            return response()->json(array("user" => "Friend not found."));
        }

    }

    public function viewupdatepassword()
    {

        return view('update-password');
    }

    public function updatepassword(Request $request)
    {

        $request->validate([
            'current_password' => ['required', 'string', 'min:8'],
            'password' => ['required', 'string', 'min:8'],
            'confirm_password' => ['required', 'string', 'min:8'],
        ]);

        if ($request->current_password != $request->password) {
            if (Hash::check($request->current_password, User::where('id', Auth::id())->first()->password)) {
                User::where('id', Auth::id())->update([
                    "password" => Hash::make($request->password)
                ]);
                return redirect("/profile")->with("update_password", "success");
            }
        } else {
            return redirect()->back()->with("error_update_password", "success");;
        }
    }

    public function updateprofile(Request $request)
    {

        //dd($request->all());

        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email',],
            'phone' => ['required', 'string'],
        ]);

        // /dd(User::where('id', Auth::id())->first()->picture);

        $dob = str_replace('T', ' ', $request->dob);

        if ($request->file('profile-picture')) {

            if (File::exists(public_path(User::where('id', Auth::id())->first()->picture))) {
                File::delete(public_path(User::where('id', Auth::id())->first()->picture));
            }

            $image = $request->file('profile-picture');
            $name = time() . '.' . $image->getClientOriginalExtension();
            $destinationPath = public_path('assets2/profile_picture/');
            $image->move($destinationPath, $name);


            User::where('id', Auth::id())->update([
                "name" => $request->name,
                "email" => $request->email,
                "phonenumber" => $request->phone,
                "picture" => '/assets2/profile_picture/' . $name,
                'fullname' => $request->fullname2,
                'dateofbirth' => $request->dateofbirth2,
                'current_states' => $request->current_state2,
                'current_city' => $request->current_city2,
                'gender' => $request->gender2,
            ]);

        } else {

            User::where('id', Auth::id())->update([
                "name" => $request->name,
                "email" => $request->email,
                "phonenumber" => $request->phone,
                'fullname' => $request->fullname2,
                'dateofbirth' => $request->dateofbirth2,
                'current_states' => $request->current_state2,
                'current_city' => $request->current_city2,
                'gender' => $request->gender2,
            ]);

        }

        return redirect()->back()->with("updated-profile", "success");
    }


    public function add_fullname(Request $request)
    {
        User::where('id', Auth::id())->update([
            "fullname" => $request->fullname
        ]);

        return response()->json(array("data" => "fullname updated"));
    }

    public function add_dob(Request $request)
    {
        User::where('id', Auth::id())->update([
            "dateofbirth" => $request->dob
        ]);

        return response()->json(array("data" => "date of birth updated"));
    }

    public function add_current_state(Request $request)
    {
        User::where('id', Auth::id())->update([
            "current_states" => $request->current_state
        ]);

        return response()->json(array("data" => "current state updated"));
    }

    public function add_current_city(Request $request)
    {
        User::where('id', Auth::id())->update([
            "current_city" => $request->current_city
        ]);

        return response()->json(array("data" => "current city updated"));
    }

    public function add_gender(Request $request)
    {
        $user = User::where('id', Auth::id())->first();

        if ($user->fullname != null && $user->dateofbirth != null && $user->current_states != null && $user->current_city != null && $user->gender == null) {
            $user->coins = $user->coins + 5000;
            $user->life = $user->life + 1;
            $user->save();
        }
        User::where('id', Auth::id())->update([
            "gender" => $request->gender
        ]);


        return response()->json(array("data" => "gender updated"));
    }


    public function registerCheck(Request $request)
    {    //lux's
        if ($request->type == 'username') {
            $users = User::all()->pluck('name');
            $users = $users->map(function ($value, $key) {
                return Str::lower($value);
            });
            if ($users->contains(Str::lower($request->name))) {
                return ['status' => 'unavailable', 'names' => [$request->name . Factory::create()->emoji, $request->name . Factory::create()->emoji, $request->name . Factory::create()->emoji]];
            } else return ['status' => 'available'];
        }

        if ($request->type == 'email') {
            $users = User::all()->pluck('email');
            if ($users->contains($request->email)) {
                return ['status' => 'unavailable'];
            } else return ['status' => 'available'];
        }
    }

    public function viewFAQ()
    {
        return view('faq');
    }
}
