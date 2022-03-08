<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Auth;
use Response;
use Session;

class AgentMiddleware
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
            if(Auth::user()->status == 1){
                Auth::logout();
                $notification = array(
                    'message' => 'আপনার একাউন্ট ডিসেবল করা হয়েছে!',
                    'alert-type' => 'error'
                );
				return redirect(url('login/user'))->with('AuthroleErrors', 'আপনার একাউন্ট ডিসেবল করা হয়েছে!')->with($notification);
            }
            
            if (auth()->user()->auth_role == 1) {
                return $next($request);
            }
            else{
                Auth::logout();

                $notification = array(
                    'message' => 'আপনার দেওয়া তথ্য সঠিক নয়!',
                    'alert-type' => 'error'
                );
                return redirect(url('login/agent'))->with('AuthroleErrors', 'You can not access the agent area!', $notification);
            }
        }
        else {
			Auth::logout();
			return redirect(url('login/agent'))->with('AuthroleErrors', 'Something wrong!');
		}
    }
}
