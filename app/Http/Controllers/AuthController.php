<?php

namespace App\Http\Controllers;

use App\Claim;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Partner;
use App\Reward;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\PartnerMail;
use Illuminate\Support\Facades\Validator;
use Faker\Factory;
use App\Mail\SendVerificationMail;
use App\NotificationSettings;
use App\Notification;
use App\UserReferral;
use App\Life_Transaction;
use App\Banner;
use App\Event;
use App\Transaction;
use App\feedback;
use App\Friend;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Carbon\Carbon;

class AuthController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth:api', ['except' => ['login']]);
    }


    public function login(Request $request)
    {
        $user = User::where('name', $request->username)->first();

        if (Hash::check($request->password, $user->password)) {
            if (Auth::attempt(array('name' => $request->username, 'password' => $request->password))) {

                $token = auth('api')->login($user);

                session(['token' => $token]);

                return response()->json(array(
                    "success" => true,
                    "token" => $token,
                    "user" => $user
                ));
            } else {
                return response()->json(array(
                    "success" => false,
                    "data" => "Wrong Username or Password"
                ));
            }
        } else {
            return response()->json(array(
                "success" => false,
                "data" => "Wrong Username or Password"
            ));
        }


        //return $this->respondWithToken($token);
    }

    public function register(Request $request)
    {
        $previousUser = User::where('email', $request->email)->first();

        if ($request->username == "" && $request->password == "" && $request->email == "" && $request->phone == "") {
            return response()->json(array(
                "success" => false,
                "data" => "Please enter the required data (username, password, email and phone)"
            ));
        } else if ($request->username == "") {
            return response()->json(array(
                "success" => false,
                "data" => "Please enter username"
            ));
        } else if ($request->phone == "") {
            return response()->json(array(
                "success" => false,
                "data" => "Please enter phone"
            ));
        } else if (strlen($request->password) < 7) {
            return response()->json(array(
                "success" => false,
                "data" => "Not Enough Password Character. Mininum 8 characters"
            ));
        } else if (!preg_match('/^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.[a-z]{2,3})$/', $request->email)) {
            return response()->json(array(
                "success" => false,
                "data" => "Invalid Email"
            ));
        } else if ($previousUser) {
            return response()->json(array(
                "success" => false,
                "data" => "Email already taken"
            ));
        }

        //dd( $request->all());

        $user = User::create([
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'gender' => 'Male',
            'email' => $request->email,
            'phonenumber' => $request->phone,
            'referral_code' => '#ONZ' . Factory::create()->unique()->passthrough(mt_rand(10000, 99999)),
            'coins' => '0',
            'life' => 3,
            'verify' => 'no',
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

        if ($request->referral) {
            $referral = User::where("referral_code", $request->referral)->first();
            //dd($referral);
            if (empty($referral)) {
                return redirect("/register")->with("referral_error", "Invalid Referral Error");
            } else {

                $referral->life = $referral->life + 1;
                $referral->save();

                $notisetting = NotificationSettings::where(["user_id" => $referral->id, "setting" => "Referral code has been used"])->first();

                if ($notisetting->in_app == "true") {

                    Notification::create([
                        "user_id" => $referral->id,
                        "notification" => $user->name . " has used your refferal code. 100 life has been added to your account",
                        "type" => "in_app",
                        "status" => "unread",
                    ]);
                }

                if ($notisetting->email == "true") {
                    Notification::create([
                        "user_id" => $referral->id,
                        "notification" => $user->name . " has used your refferal code. 100 life has been added to your account",
                        "type" => "email",
                        "status" => "unsend",
                    ]);
                }

                UserReferral::create([
                    "user_id" => $user->id,
                    "referral_id" => $referral->id,
                ]);

                Life_Transaction::create([
                    "transaction_type" => "user_referred",
                    "transaction_value" => "1",
                    "user_id" => $user->id,
                ]);
            }
        }

        Mail::to($request->email)->send(new SendVerificationMail($user->verificationcode));

        $token = auth('api')->login($user);

        if ($token) {
            return response()->json(array(
                "success" => true,
                "token" => $token,
                "user" => $user
            ));
        } else {
            return response()->json(array(
                "success" => false,
                "data" => "No Token Created"
            ));
        }
    }


    public function verification(Request $request)
    {
        $user = User::where('id', $request->userid)->first();
        if ($request->verification != $user->verificationcode) {
            return response()->json(array(
                "success" => false,
                "data" => "Wrong Verification Code"
            ));
        } else {
            return response()->json(array(
                "success" => true,
                "data" => "success"
            ));
        }
    }

    public function leaderboadfriend(Request $request)
    {
        //return response()->json($request->all());
        $friends = User::where('id', $request->id)->with('friends')->first();
        $friendlist = collect();

        foreach ($friends->friends as $friend) {
            $friendlist->push(User::where('id', $friend->friend_id)->first());
        }


        return view('mobile.scoreboardfriend', compact('friendlist'));
    }

    public function leaderboadall(Request $request)
    {
        //return response()->json($request->all());
        $alllist = User::all()->sortByDesc('coins')->take(10);


        return view('mobile.scoreboardall', compact('alllist'));
    }

    public function logout(Request $request)
    {
        if (!User::checkToken($request)) {
            return response()->json([
                'message' => 'Token is required',
                'success' => false,
            ], 422);
        }

        try {
            JWTAuth::invalidate(JWTAuth::parseToken($request->token));
            return response()->json([
                'success' => true,
                'message' => 'User logged out successfully'
            ]);

        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    public function getCurrentUser(Request $request)
    {
        //return response()->json($request->all());
        if (!User::checkToken($request)) {
            //return response()->json("false");
            return response()->json([
                'message' => 'Token is required'
            ]);
        }

        $user = JWTAuth::parseToken()->authenticate();
        return response()->json(["user" => $user]);
    }

    public function becomepartner(Request $request)
    {
        //return response()->json($request->all());
        $partner = Partner::create([
            "name" => $request->name,
            "company" => $request->company,
            "position" => $request->position,
            "email" => $request->email,
            "contact_number" => $request->contact_number
        ]);

        Mail::to('ashaariazman@cakexp.com')->send(new PartnerMail($partner));

        return response()->json(["success" => true, "data" => "Data successfully saved"]);
    }

    public function getNotiSettingsData(Request $request)
    {
        //return response()->json($request->all());
        $user = JWTAuth::parseToken()->authenticate();

        $noti = NotificationSettings::where(["user_id" => $user->id])->get();

        return response()->json(["notiSetting" => $noti]);
    }

    public function postNotiSettingsData(Request $request)
    {
        //return response()->json($request->all());
        $user = JWTAuth::parseToken()->authenticate();
        if ($request->type == "email") {
            if ($request->data == true) {
                NotificationSettings::where(["user_id" => $user->id, "setting" => $request->key])
                    ->update(["email" => "true"]);

                return response()->json(["success" => "Notification update successful"]);
            }
            if ($request->data == false) {
                NotificationSettings::where(["user_id" => $user->id, "setting" => $request->key])
                    ->update([
                        "email" => "false",
                    ]);

                return response()->json(["success" => "Notification update successful"]);
            }
        }

        if ($request->type == "in_app") {
            if ($request->data == true) {
                NotificationSettings::where(["user_id" => $user->id, "setting" => $request->key])
                    ->update([
                        "in_app" => "true",
                    ]);

                return response()->json(["success" => "Notification update successful"]);
            }
            if ($request->data == false) {
                NotificationSettings::where(["user_id" => $user->id, "setting" => $request->key])
                    ->update([
                        "in_app" => "false",
                    ]);

                return response()->json(["success" => "Notification update successful"]);
            }
        }
    }


    public function viewReferral()
    {
        $user = JWTAuth::parseToken()->authenticate();
        $user->referral_code;

        return response()->json(["referral_code" => $user->referral_code]);
    }

    public function editPassword(Request $request)
    {
        $user = JWTAuth::parseToken()->authenticate();

        if (Hash::check($request->current, $user->password)) {
            User::where('id', $user->id)->update([
                "password" => Hash::make($request->new)
            ]);
            return response()->json(["success" => true, "data" => "Password Updated"]);
        } else {
            return response()->json(["success" => false, "data" => "Error Current Password"]);
        }
    }

    public function editUserData2(Request $request)
    {
        //return response()->json($request->all());

        $user = JWTAuth::parseToken()->authenticate();

        User::where('id', $user->id)->update([
            "fullname" => $request->fullname,
            "gender" => $request->gender,
            "dateofbirth" => $request->birthday,
            "current_states" => $request->state,
            "current_city" => $request->city,
        ]);

        return response()->json(["success" => true, "data" => "User Updated"]);
    }

    public function editUserData(Request $request)
    {
        //return response()->json($request->all());

        $user = JWTAuth::parseToken()->authenticate();

        User::where('id', $user->id)->update([
            "name" => $request->name,
            "email" => $request->email,
            "phonenumber" => $request->phone,
        ]);

        return response()->json(["success" => true, "data" => "User Updated"]);
    }

    public function viewMainPage($id)
    {
        //dd(session());
        //return response()->json($id);
        //$user = JWTAuth::parseToken()->authenticate();
        //dd(auth()->user());
        //dd(session("token"));

        $banner = Banner::get()->take(5);
        $event = Event::where('event_end_date', '>', now())->paginate(4);
        $noti = Notification::where(["user_id" => $id, "status" => "unread"])->count();
        $i = 0;

        return view('mobile.mobileMainPage', compact(
            'banner',
            'event',
            'i',
            'noti'
        ));
    }

    public function viewRedeemPage($id)
    {
        $user = User::where('id', $id)->first();
        $reward = Reward::with('reward_count')->get();
        return view('mobile.mobileRedeemPage', compact('reward', 'user'));
    }


    public function viewRedeemPageDetails($user_id, $reward_id)
    {
        $user = User::where('id', $user_id)->first();
        $r = Reward::where('id', $reward_id)->with('reward_count')->first();
        return view('mobile.mobileRedeemPageDetails', compact('r', 'user'));
    }

    public function rewardFilterButton(Request $request)
    {
        if ($request->reward_type != 'all') {
            $reward = Reward::where('reward_type', $request->reward_type)->with('claim')->get();
        } else {
            $reward = Reward::with('claim')->get();
        }

        return ['reward' => $reward];
    }

    public function addVoucher(Request $request)
    {
        $reward = Reward::where([
            'id' => $request->reward_id,
        ])->with('claim')->first();

        $claim_slot = $reward->claim->filter(function ($c) {
            return (($c->unlist_date > now() || $c->unlist_date == null) && $c->user_id == null);
        });
        //dd($claim_slot->isNotEmpty());
        $user = User::where('id', $request->user_id)->first();

        if ($claim_slot->isNotEmpty() && $user->coins >= $reward->cost_in_coins) {

            $claim_slot->first()->update([
                'user_id' => $user->id,
            ]);

            $user->update([
                'coins' => ($user->coins - $reward->cost_in_coins),
            ]);

            Transaction::create([
                'transaction_type' => 'redeemed_reward',
                'transaction_value' => '-' . $reward->cost_in_coins,
                'user_id' => $request->user_id,
                'reward_id' => $request->reward_id,
            ]);

            return response()->json(['success' => 'true', 'message' => 'Reward redeemed !!']);
        } else return response()->json(['success' => 'false', 'message' => 'either you are poor or you are a hacker >:p']);
    }

    public function qrmobileview($friend_id)
    {
        $user_id = $friend_id;

        return view('mobile.qr', compact('user_id'));
    }

    public function mobile_add_friend($friend_id)
    {
        //return response()->json($request->all());

        if ($friend_id == $user_id) {
            return redirect('/qr')->with('error', 'You cannot be friends with yourself :(');
        } else {
            //$usernoti = NotificationSettings::where(["user_id" => Auth::id(), "type" => "Your friend request approved"])->first();
            $friend = User::where("id", $friend_id)->first();
            $check = Friend::where(["user_id" => $friend_id, "friend_id" => $user_id])->first();
            $check_friend = Friend::where(["user_id" => $user_id, "friend_id" => $friend_id])->first();
            //dd(empty($check) , empty($check_friend));

            if (empty($check) && empty($check_friend)) {
                Friend::create([
                    "user_id" => $user_id,
                    "friend_id" => $friend_id,
                    "status" => "approved",
                ]);
                Friend::create([
                    "user_id" => $friend_id,
                    "friend_id" => $user_id,
                    "status" => "approved",
                ]);
                return redirect('/qr')->with('success', 'You are now friends with ' . $friend->name . '!');
            } else {
                return redirect('/qr')->with('error', 'Both of you are already friends :)');
            }
        }
    }


    // My Friends - Start
    public function viewMyFriendsList($id)
    {
        $user_id = $id;
        $friends = User::where('id', $id)->with('friends')->first();
        // Myr: For when we start using token
        // $user = JWTAuth::parseToken()->authenticate();
        // $friends = User::where('id', $user->id)->with('friends')->first();
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
        return view('mobile.mobileMyFriendsList', compact(
            'unapprove',
            'friendlist',
            'user_id'
        ));
    }

    public function deleteFriend(Request $request)
    {
        $user = Friend::where(["user_id" => $request->user_id, "friend_id" => $request->friend_id])->first();
        $friend = Friend::where(["user_id" => $request->friend_id, "friend_id" => $request->user_id])->first();

        if ($user) {
            $user->delete();
            $friend->delete();

            return response()->json(array("user" => "Friend deleted successfully", "id" => $request->friend_id));
        } else {
            return response()->json(array("user" => "Friend not found"));
        }
    }

    public function viewMyFriendsFriendRequest($id)
    {
        $user_id = $id;
        $friends = User::where('id', $id)->with('friends')->first();
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
        return view('mobile.mobileMyFriendsFriendRequest', compact(
            'unapprove',
            'friendlist',
            'user_id'
        ));
    }

    public function acceptFriend(Request $request)
    {
        Friend::where(["user_id" => $request->friend_id, "friend_id" => $request->user_id])->update([
            "status" => "approved",
        ]);
        Friend::where(["user_id" => $request->user_id, "friend_id" => $request->friend_id])->update([
            "status" => "approved",
        ]);
        $notisetting = NotificationSettings::where(["user_id" => $request->user_id, "setting" => "Your friend request approved"])->first();
        //dd($notisetting->email);
        $friendsetting = NotificationSettings::where(["user_id" => $request->friend_id, "setting" => "Your friend request approved"])->first();
        //dd($friendsetting);
        if ($notisetting->email == "true") {
            Notification::create([
                "user_id" => $request->user_id,
                "notification" => "You have acceptted a friend request from " . User::where('id', $request->friend_id)->first()->name . '.',
                "type" => "email",
                "status" => "dispatch"
            ]);
        }
        if ($friendsetting->email == "true") {
            Notification::create([
                "user_id" => $request->addfriend,
                "notification" => User::where('id', $request->user_id)->first()->name . " has accepted your friend request.",
                "type" => "email",
                "status" => "unsend"
            ]);
        }
        if ($notisetting->in_app == "true") {
            Notification::create([
                "user_id" => $request->user_id,
                "notification" => "You have accepted a friend request from " . User::where('id', $request->friend_id)->first()->name . '.',
                "type" => "in_app",
                "status" => "unsend"
            ]);
        }
        if ($friendsetting->in_app == "true") {
            Notification::create([
                "user_id" => $request->addfriend,
                "notification" => User::where('id', $request->user_id)->first()->name . " has accepted your friend request.",
                "type" => "in_app",
                "status" => "unread"
            ]);
        }
        return response()->json(array("data" => 'You have approved the friend request.', "user" => User::where('id', $request->friend_id)->first()));
    }

    public function viewMyFriendsAddFriend($id)
    {
        $user_id = $id;
        $friends = User::where('id', $id)->with('friends')->first();
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
        return view('mobile.mobileMyFriendsAddFriend', compact(
            'unapprove',
            'friendlist',
            'user_id'
        ));
    }

    public function searchFriend(Request $request)
    {
        $search_user = [];
        $friendlist = [];
        $user = User::where('name', 'LIKE', '%' . $request->search_data . '%')->get();
        $friends = User::where('id', $request->user_id)->with('friends')->first();
        foreach ($user as $us) {
            if ($us->name != User::where('id', $request->user_id)->first()->name) {
                $search_user[] = $us->name;
            }
        }
        foreach ($friends->friends as $friend) {
            if ($friend->name != User::where('id', $request->user_id)->first()->name) {
                $friendlist[] = (User::where('id', $friend->friend_id)->first()->name);
            }
        }
        $filter_user = array_diff($search_user, $friendlist);
        $user_collect = collect();

        foreach ($filter_user as $fu) {
            $user_collect->push(User::where('name', $fu)->first());
        }
        return response()->json(array("user" => $user_collect));
    }

    public function addFriend(Request $request)
    {
        $friends = Friend::where(["user_id" => $request->user_id, "friend_id" => $request->friend_id])->first();
        $user = User::where('id', $request->friend_id)->first();
        if (!$friends) {
            Friend::create([
                "user_id" => $request->friend_id,
                "friend_id" => $request->user_id,
                "status" => "unapproved",
            ]);
            Friend::create([
                "user_id" => $request->user_id,
                "friend_id" => $request->friend_id,
                "status" => "waiting",
            ]);
            $notisetting = NotificationSettings::where(["user_id" => $request->user_id, "setting" => "Friend request"])->first();
            $friendsetting = NotificationSettings::where(["user_id" => $request->friend_id, "setting" => "Friend request"])->first();
            if ($notisetting->email == "true") {
                Notification::create([
                    "user_id" => $request->user_id,
                    "notification" => "You have sent a friend request to " . User::where('id', $request->friend_id)->first()->name . '.',
                    "type" => "email",
                    "status" => "unsend"
                ]);
            }
            if ($notisetting->in_app == "true") {
                Notification::create([
                    "user_id" => $request->user_id,
                    "notification" => "You have sent a friend request to " . User::where('id', $request->friend_id)->first()->name . '.',
                    "type" => "in_app",
                    "status" => "unread"
                ]);
            }
            if ($friendsetting->email == "true") {
                Notification::create([
                    "user_id" => $request->friend_id,
                    "notification" => User::where('id', $request->user_id)->first()->name . " has sent you a friend request.",
                    "type" => "email",
                    "status" => "unsend"
                ]);
            }
            if ($friendsetting->in_app == "true") {
                Notification::create([
                    "user_id" => $request->friend_id,
                    "notification" => User::where('id', $request->user_id)->first()->name . " has sent you a friend request.",
                    "type" => "in_app",
                    "status" => "unread"
                ]);
            }
            return response()->json(array("message" => "waiting to be approved", "user" => $user = User::where('id', $request->friend_id)->first()));
        } else {
            return response()->json(array("message" => "Both of you are already friends!"));
        }
    }

    // My Friends - End

    public function notifications($id)
    {
        $noti = Notification::where(['user_id' => $id, "type" => "in_app"])->orderBy('created_at', 'desc')->get();
        $notiArray = [];

        foreach ($noti as $n) {
            //dd($n->created_at->diffForHumans(Carbon::now()));
            $notiArray[] = ["id" => $n->id, "notification" => $n->notification, "time_difference" => ($n->created_at->diffForHumans(Carbon::now())), "status" => $n->status];
        }
        // /dd($notiArray);

        return view('mobile.notification', compact('notiArray'));
    }

    public function mobile_community($id)
    {
        $user_id = $id;
        return view('mobile.mobilefeedback', compact('user_id'));
    }

    public function create_community(Request $request)
    {
        //dd($request->all());
        feedback::create([
            "user_id" => $request->user_id,
            "exp" => $request->q1,
            "rating" => $request->q2,
            "frequency" => $request->q3,
            "recommend" => $request->q4,
            "comment" => $request->q5
        ]);

        return response()->json(array("data", "feedback created"));
    }

    public function notification_update(Request $request)
    {
        Notification::where('id', $request->id)->update([
            "status" => "read",
        ]);

        return response()->json(array("data", "notification status update"));
    }

    public function viewVoucher($id)
    {
        $reward = Reward::with('claim')->get();
        $reward = $reward->filter(function ($value) use ($id) {
            return $value->claim->contains(function ($klem) use ($id) {
                return $klem->user_id == $id;
            });
        });

        //dd($reward[0]->claim->where('user_id', $id));
        /* dd($reward->last()->claim->filter(function($r) use ($id){
            return $r->user_id == $id;
        })); // dont delete cuz this formula is important*/

        return view('mobile.mobileMyRedeem', compact('reward', 'id'));
    }

    public function viewMyRedeemDetails($redeem_id, $claim_id)
    {
        $r = Reward::where('id', $redeem_id)->with('reward_count')->first();
        $c = Claim::where('id', $claim_id)->first();
        //dd($c);
        return view('mobile.mobileMyRedeemDetails', compact('r', 'c'));
    }

    public function useReward(Request $request)
    {
        $claim = Claim::where('id', $request->claim_id)->first();
        if ($claim->status == 'valid') $claim->update(['status' => 'used']);
        return ['code' => $claim->reward_code];
    }

    public function notification_count(Request $request)
    {
        $noti = Notification::where(["user_id" => $request->id, "status" => "unread"])->get()->count();
        return ['noti_count' => $noti];
    }

    public function rewardFilterInput(Request $request)
    {
        $reward = Reward::where('reward_name', 'LIKE', '%' . $request->reward_name . '%')->with('claim')->get();
        return ['status' => 'available', 'reward' => $reward];
    }
}
