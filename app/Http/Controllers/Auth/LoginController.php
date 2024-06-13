<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => ['required'],
            'password' => ['required'],
        ]);

        $username = $request->username;
        //dd($username);
        $password = $request->password;
        $user = User::where('name', $username)->first();
        $userEmail = User::where('email', $username)->first();
        //dd($username);
        //dd($userEmail == null , $user == null);
        //dd( $userEmail);


        if ($user != null) {
            if (Hash::check($password, $user->password)) {
                if ($user->verify == 'yes' && $user->email_verified_at != NULL) {
                    Auth::login($user);
                    if (Auth::attempt(array('name' => $request->username, 'password' => $request->password))) {
                        return redirect('/main');
                    } else {
                        return redirect('/login')->with('message', 'Invalid credentials');
                    }
                } else {
                    //Alert::error('Account not verified.', 'Please verify your account in the email first.');
                    return view('verification', ['user_id' => $user->id])->with('message', 'Account not verified.');
                }
            } else {
                //Alert::error('Invalid credentials.', 'The username/password does not match.');
                return redirect()->back()->withErrors(['message' => 'Invalid credentials.']);
            }
        } elseif ($userEmail != null) {
            if (Hash::check($password, $userEmail->password)) {
                if ($userEmail->verify == 'yes' && $userEmail->email_verified_at != NULL) {
                    Auth::login($userEmail);

                    if (Auth::attempt(array('email' => $request->username, 'password' => $request->password))) {
                        return redirect('/main');
                    } else {
                        return view('login');
                    }
                } else {
                    //Alert::error('Account not verified.', 'Please verify your account in the email first.');
                    return view('verification', ['user_id' => $userEmail->id])->with('message', 'Account not verified.');
                }
            } else {
                //Alert::error('Invalid credentials.', 'The username/password does not match.');
                return redirect()->back()->withErrors(['message' => 'Invalid credentials.']);
            }
        } else {
            //Alert::error('User does not exist.');
            return redirect()->back()->withErrors(['message' => 'User does not exist!']);
        }
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->intended('/');
    }
}
