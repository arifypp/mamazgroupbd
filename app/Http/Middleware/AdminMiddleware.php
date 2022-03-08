<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Response;
use Session;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            if (auth()->user()->auth_role == 3) {
                return $next($request);
            }
            else{
                Auth::logout();
                $notification = array(
                    'message' => 'অনুগ্রহ করে সঠিক লিংক ব্যবহার করুন!',
                    'alert-type' => 'error'
                );
                return redirect(url('login/admin'))->with('AuthroleErrors', 'You can not access the admin area!')->with($notification);
            }
        }
        else {
			Auth::logout();
			return redirect(url('login/admin'))->with('AuthroleErrors', 'Something wrong!');
		}
    }
}
