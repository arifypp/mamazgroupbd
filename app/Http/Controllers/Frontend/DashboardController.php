<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Frontend.user.dashboard');
    }

    public function updatepromoid(Request $request, $id)
    {
        $promotelevel = User::find($id);
        if( $promotelevel->auth_promote == Auth::user()->auth_promote )
        {
            $promotelevel->auth_promote += 1;
        }
        $promotelevel->save();
        return response()->json(['success' =>true, 'message'=> 'Level is up now!!!']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function usersetting($username)
    {
        //
        $users = User::where('username',$username)->first();
        if( !empty($users) )
        {
            return view('Frontend.user.userprofile', compact('users'));
        }
        else
        {
            $notification = array(
                'message'       => 'ডাটা পাওয়া যায়নি!!!',
                'alert-type'    => 'error'
            );    
            return back()->with($notification);
        }
    }

    public function updateuser(Request $request, $id)
    {
        $user = User::find($id);
        if( !empty($user) )
        {
            $user->name         =   $request->name;
            $user->username     =   $request->username;
            $user->email        =   $request->email;
            $user->address      =   $request->address;
            $user->dob          =   $request->dob;

            $user->save();

            return response()->json(['success' =>true, 'message'=> 'ডাটা সেভ হয়েছে!!!']);

        }
        else
        {
            $notification = array(
                'message'       => 'ডাটা পাওয়া যায়নি!!!',
                'alert-type'    => 'error'
            );    
            return response()->json(['success' =>true, 'message'=> 'ডাটা পাওয়া যায়নি!!!']);
        }
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
    }
}
