<?php

namespace App\Http\Middleware;
use App\User;
use Closure;

class VerifiedLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $username = $request->username;
        $user = User::where('name', '=', $username)->first();
        if($user != NULL){
            return redirect()->intended('/main');
        }
        else{
            return redirect('/login');
        }
        return $next($request);
    }
}
