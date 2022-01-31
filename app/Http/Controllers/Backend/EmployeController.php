<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Booking;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DB;
use Image;
use Session;
class EmployeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $user  = User::orderBy('id', 'desc')->where('auth_role', 2)->get();
        return view('Backend.employe.manage', compact('user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Backend.employe.create');
    }
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'unique:users', 'alpha_dash', 'min:3', 'max:30'],
            'phone' => ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6'],
            'dob' => ['required', 'date', 'before:today'],
        ],
        $message = [
            'name.required'     =>   'আপনার পুরো নাম',
            'name.max'     =>   'আপনার নামের সংখ্যা অতিরিক্ত হয়েছে',
            'name.string'     =>   'আপনার পুরো নাম',
            'username.required'     =>   'ইউজার নেম লিখুন',
            'username.string'     =>   'ইউজার নেম লিখুন',
            'username.unique'     =>   'ইউনিক ইউজার নেম দিন',
            'username.alpha_dash'     =>   'সঠিকভাবে লিখুন',
            'username.max'     =>   'অতিরিক্ত বেশি সংখ্যা লিখেছেন',
            'username.min'     =>   'ইউজার নেম চার অক্ষরের হতে হবে',
            'phone.required'     =>   'আপনার ফোন নাম্বার লিখুন',
            'phone.min'     =>   'আপনার ফোন নাম্বার সংখ্যা কম হয়েছে',
            'phone.numeric'     =>   'আপনার ফোন নাম্বার সঠিক হয়নি',
            'email.required'     =>   'আপনার ইমেইল লিখুন',
            'email.string'     =>   'আপনার ইমেইল সঠিকভাবে লিখুন',
            'email.email'     =>   'আপনার ইমেইল ব্যবহৃত হচ্ছে না',
            'email.max'     =>   'আপনার ইমেইল সংখ্যা অতিরিক্ত বেশি',
            'email.unique'     =>   'এই ই-মেইলটি পূর্বে ব্যবহৃত হয়েছে',
            'password.required'     =>   'পাসওয়ার্ডটি সঠিকভাবে দিন',
            'dob.required'     =>   'আপনার জন্ম তারিখ দিন',
            'dob.before'     =>   'আপনার জন্ম তারিখ দিন সঠিকভাবে',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        
        //
        $this->validator($request->all())->validate();

        if (request()->has('avatar')) {            
            $avatar = request()->file('avatar');
            $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
            $avatarPath = public_path('/images/');
            $avatar->move($avatarPath, $avatarName);
        }
        $referrer = User::whereUsername(session()->pull('referrer'))->first();


        User::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'username' => $request['username'],
            'email' => $request['email'],
            'auth_role' =>  2,
            'referrer_id' => $referrer ? $referrer->id : null,
            'password' => Hash::make($request['password']),
            'dob' => date('Y-m-d', strtotime($request['dob'])),
            'avatar' => "/images/" . $avatarName,

        ]);

        $notification = array(
            'message'       => 'এমপ্লয়ী তৈরি সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('employe.manage')->with($notification);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $user = User::find($id);
        
        if( !is_null($user) )
        {
            return view('Backend.employe.edit', compact('user'));
        }
        else{
            $notification = array(
                'message'       => 'ডাটা খুজে পাচ্ছি না!!!',
                'alert-type'    => 'warning'
            );

            return back()->with($notification);

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $user = User::find($id);        
        if( !is_null($user) )
        {
            if (request()->has('avatar')) {            
                $avatar = request()->file('avatar');
                $avatarName = time() . '.' . $avatar->getClientOriginalExtension();
                $avatarPath = public_path('/images/');
                $avatar->move($avatarPath, $avatarName);

                $user->avatar      = "/images/" . $avatarName;
            }
            $referrer = User::whereUsername(session()->pull('referrer'))->first();
            
            $user->name        = $request['name'];
            $user->phone       = $request['phone'];
            $user->username    = $request['username'];
            $user->email       = $request['email'];
            $user->referrer_id = $referrer ? $referrer->id : null;
            if( $request->password )
            {
                $user->password    = Hash::make($request['password']);
            }
            $user->dob         = date('Y-m-d', strtotime($request['dob']));

            $user->save();

            $notification = array(
                'message'       => 'কাস্টমার আপডেট সম্পন্ন হয়েছে!!!',
                'alert-type'    => 'success'
            );
    
            return redirect()->route('customer.manage')->with($notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $delete = User::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "ডিলেট সম্পন্ন হয়েছে!!!";
            
        } else {
            $success = true;
            $message = "ডিলেটে ত্রুটি রয়েছে!!!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
