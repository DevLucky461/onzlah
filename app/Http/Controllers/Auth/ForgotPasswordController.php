<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\User;
use Faker\Factory;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset emails and
    | includes a trait which assists in sending these notifications from
    | your application to your users. Feel free to explore this trait.
    |
    */

    use SendsPasswordResetEmails;

    public function view()
    {
        return view('forgot-password');
    }

    public function sendLink(Request $request)
    {
        if ($request->email != null) {
            $faker = Factory::create();
            $password = Str::upper($faker->bothify($faker->randomElement(['#', '?']) . $faker->randomElement(['#', '?']) . $faker->randomElement(['#', '?']) . $faker->randomElement(['#', '?']) . $faker->randomElement(['#', '?']) . $faker->randomElement(['#', '?']) . $faker->randomElement(['#', '?']) . $faker->randomElement(['#', '?']) . $faker->randomElement(['#', '?'])));
            //dd($password);
            $user = User::where('email', $request->email)->first();
            $user->update([
                'password' => Hash::make($password)
            ]);
            Mail::to($request->email)->send(new \App\Mail\ForgotPassword($password));
        }

        return view('forgot-password-after');
    }
}
