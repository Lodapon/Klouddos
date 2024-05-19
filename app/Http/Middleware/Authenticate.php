<?php

namespace App\Http\Middleware;

use App\Http\Utils\SecureUtil;
use Closure;
use Exception;
use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class Authenticate extends Middleware
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

        $username = $request['usr'];
        $password = $request['pwd'];

        Log::debug("Authenicating with ". $username);

        try {
//            Log::debug(user_account::all());
            $user_account = DB::selectOne('select distinct * from user_account where username = ?', [$username]);
            $hashLv2 = SecureUtil::hashing(array($username, $password, $user_account->salt));

            if($hashLv2 == $user_account->password) {
                Log::debug("password matched");

                if ($user_account->role == "S") {
                    session()->put("admin", true);
                    return redirect('/admin');
                }

                if ($user_account->status == "A") {
//                Auth::setUser(new User($username));
                    $user_account->password = null;
                    $user_account->salt = null;
                    session()->put("user", $user_account);

                    $hotelDesc = DB::selectOne('select distinct * from hotel_desc where account_id = ?', [$user_account->account_id]);
                    session()->put("hotel", $hotelDesc);



                    return $next($request);
                } else {
                    return redirect('/')->with('message', 'Waiting for approval, Please contact administrator.');
                }

            } else {
                Log::error("password mismatched");
                return redirect('/')->with('message', 'Invalid Credential');
            }

        } catch (Exception $e) {
            Log::error("can't find user_account");
            return redirect('/')->with('message', 'Invalid Credential');
        }

    }


    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        if (! $request->expectsJson()) {
            return route('login');
        }
    }
}
