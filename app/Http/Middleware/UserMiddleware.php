<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Response;
use Session;

class UserMiddleware
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
            // Status checking 
            if(Auth::user()->status == 1){
                Auth::logout();
                $notification = array(
                    'message' => 'আপনার একাউন্ট ডিসেবল করা হয়েছে!',
                    'alert-type' => 'error'
                );
				return redirect(url('login/user'))->with('AuthroleErrors', 'আপনার একাউন্ট ডিসেবল করা হয়েছে!')->with($notification);
            }

            if (auth()->user()->auth_role == 0) {
                return $next($request);
            }
            else{
                Auth::logout();
                $notification = array(
                    'message' => 'দু:খিত সঠিক লিঙ্ক ব্যবহার করুন!',
                    'alert-type' => 'error'
                );
                return redirect(url('login/user'))->with('AuthroleErrors', 'You can not access the user area!')->with($notification);
            }
        }
        else {
			Auth::logout();
            return redirect(url('login/user'))->with('AuthroleErrors', 'Something wrong!');

		}
        
        //if not user 
        // return back()->with('error', 'You\'re not authenticate user');
        
    }
}
