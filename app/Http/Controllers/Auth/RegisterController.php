<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Events\UserRegistrationEvent;
use View;
use Response;
use Session;

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
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'firstname' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'lang'      =>  ['required', 'not_in:0'],
            'address'   =>  ['required'],
            'address2'  =>  ['required'],
            'city'      =>  ['required'],
            'postcode'  =>  ['required'],
            'country'   =>  ['required', 'not_in:0'],
            'username' => ['required', 'string', 'unique:users', 'alpha_dash', 'min:3', 'max:30'],
            'phone' => ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
            'dob' => ['required', 'date', 'before:today'],
            'agreementone' =>   ['required'],
            'agreementtwo' =>   ['required'],

            // 'avatar' => ['required', 'image' ,'mimes:jpg,jpeg,png','max:1024'],
        ]);
    }


    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForm(Request $request)
    {
        if ($request->has('ref')) {
            session(['referrer' => $request->query('ref')]);
        }
        return view('auth.register', ['url'=>'ref']);
    }

    public function createRefUser(Request $request)
    {
        $this->validator($request->all())->validate();

        if (request()->has('avatar')) {            
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }
        $referrer = User::whereUsername(session()->pull('referrer'))->first();


        $refuser = User::create([
            'name' => $request['firstname']." ".$request['lastname'],
            'phone' => $request['phone'],
            'address' => $request['address']." ".$request['address2']." ".$request['city']." ".$request['postcode']." ".$request['country'],
            'username' => $request['username'],
            'email' => $request['email'],
            'referrer_id' => $request['referrer_id'],
            'password' => Hash::make($request['password']),
            'dob' => date('Y-m-d', strtotime($request['dob'])),
            // 'avatar' => "/images/" . $avatarName,

        ]);
        $notification = array(
            'message' => '???????????????????????????????????? ????????????????????? ???????????????!',
            'alert-type' => 'success'
        );

       // return View::make('auth.thankyou')->with(compact('teacher'));
       return view('auth.thankyou', ['user' => $refuser])->with($notification);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(Request $request)
    {

        if (request()->has('avatar')) {            
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }
        $referrer = User::whereUsername(session()->pull('referrer'))->first();
        
        $user = User::create([
            'name' => $request['firstname']." ".$request['lastname'],
            'phone' => $request['phone'],
            'address' => $request['address']." ".$request['address2']." ".$request['city']." ".$request['postcode']." ".$request['country'],
            'username'    => $request['username'],
            'email' => $request['email'],
            'referrer_id' => $referrer ? $referrer->id : null,
            'password' => Hash::make($request['password']),
            'dob' => date('Y-m-d', strtotime($request['dob'])),
            // 'avatar' => "/images/" . $avatarName,
        ]);

        // event(new UserRegistrationEvent($user));
        // return $user;
        $notification = array(
            'message' => '???????????????????????????????????? ????????????????????? ???????????????!',
            'alert-type' => 'success'
        );
        return view('auth.thankyou', ['user' => $user])->with($notification);



    }

    // User Registration Form
    public function ShowRegiterForm(){
        return view('auth.register', ['url'=>'user']);
    }
    

    // User created  
    protected function createUser(Request $request){

       $this->validator($request->all())->validate();

        if (request()->has('avatar')) {            
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }
        $referrer = User::whereUsername(session()->pull('referrer'))->first();


        $teacher = User::create([
            'name' => $request['firstname']." ".$request['lastname'],
            'phone' => $request['phone'],
            'address' => $request['address']." ".$request['address2']." ".$request['city']." ".$request['postcode']." ".$request['country'],
            'username' => $request['username'],
            'email' => $request['email'],
            'referrer_id' => $referrer ? $referrer->id : null,
            'password' => Hash::make($request['password']),
            'dob' => date('Y-m-d', strtotime($request['dob'])),
            // 'avatar' => "/images/" . $avatarName,

        ]);

        $notification = array(
            'message' => '???????????????????????????????????? ????????????????????? ???????????????!',
            'alert-type' => 'success'
        );

       // return View::make('auth.thankyou')->with(compact('teacher'));
       return view('auth.thankyou', ['user' => $teacher])->with($notification);
    }

    public function ShowAgentRegiterForm()
    {
        return view('auth.register', ['url'=>'agent']);
    }

    public function createAgentUser(Request $request)
    {
        $this->validator($request->all())->validate();

        if (request()->has('avatar')) {            
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }


        $teacher = User::create([
            'name' => $request['firstname']." ".$request['lastname'],
            'phone' => $request['phone'],
            'address' => $request['address']." ".$request['address2']." ".$request['city']." ".$request['postcode']." ".$request['country'],
            'username' => $request['username'],
            'email' => $request['email'],
            'password' => Hash::make($request['password']),
            'dob' => date('Y-m-d', strtotime($request['dob'])),
            'auth_role' =>  1,
            // 'avatar' => "/images/" . $avatarName,

        ]);

        $notification = array(
            'message' => '???????????????????????????????????? ????????????????????? ???????????????!',
            'alert-type' => 'success'
        );
        return Redirect()->route('Agentlogin')->with($notification);
    }

}
