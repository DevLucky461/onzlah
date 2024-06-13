<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\User;
use App\UserReferral;
use App\Life_Transaction;
use App\Mail\SendVerificationMail;
use App\Mail\PreregisterMail;
use App\Mail\PrelaunchMail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Str;
use App\Notification;
use App\NotificationSettings;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }

    public function showRegistrationForm()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required', 'min:8'],
            'email' => ['required', 'email', 'max:255', 'unique:users'],
            'phone' => ['required', 'unique:users,phonenumber'],
        ], [
            'email.unique' => 'This email already existed',
            'phone.unique' => 'This phone number is already in use',
        ]);

//        dd( $request->all());

        $user = User::create([
            'name' => $request->username,
            'password' => Hash::make($request->password),
            'email' => $request->email,
            'phonenumber' => $request->phone,
//            'referral_code ' => $request->referral,
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

        //Mail::to($request->email)->send(new SendVerificationMail($user->verificationcode));
        Mail::to($request->email)->send(new PrelaunchMail($user->verificationcode));

        if ($request->source == 'web') return Redirect::to(URL::previous() . "#signup-now")->with('success', 'Your account has been created. You will receive a confirmation code during the launch day through your registered email. Thank you');
        else return view('verification', ['user_id' => $user->id]);
    }

    public function viewVerify()
    {
        return view('verification');
    }

    public function verify(Request $request)
    {
        $user = User::where('id', $request->user_id)->first();
        //$user_id = $user->id;
        //dd($user_id);
        if ($request->digit == $user->verificationcode) {
            $user->update([
                'verify' => 'yes',
                'email_verified_at' => date('Y-m-d H:i:s'),
            ]);
            Auth::login($user);
            if (Auth::check() == true) {
                return redirect('/main');
            } else {
                return view('login');
            }
        } else {
            Alert::toast('Incorrect Verification Code.');
            return view('verification', ['user_id' => $user->id]);
        }
    }

    public function registerCheck(Request $request)
    {
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
}
