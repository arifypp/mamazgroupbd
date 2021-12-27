<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Auth;
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

    // This is for user login form
    public function showUserloginform(){
        return view('auth.login', ['url'=>'user']);
    }
    // this is for user login access 
    public function Userlogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:8'
        ]);
    

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], true)) {
            if(Auth::user()->is_super == 0)
            {
                return redirect()->route('user.dashboard');
            }
            
        }
        return back()->withInput($request->only('email', 'remember'))->withErrors(
            [
                'email' => 'Email or Password doesn\'t matched in our database!',
                'status_error'  => 'testing',
            ]
        );
    }

}
