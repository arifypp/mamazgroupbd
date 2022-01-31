<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\SignupCash;
use App\Models\Backend\TotalAmount;
use App\Notifications\Signupcashpayment;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use Response;
use Session;

class TotalAmmountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
        $request->validate([
            'bookingmoneymehtod'    =>  ['required', 'not_in:0'],
            'bkashtransiction'      =>  ['required_if:bookingmoneymehtod,bkash'],
            'bkashnumber'           =>  ['required_if:bookingmoneymehtod,bkash'],
            'nagadtransiction'      =>  ['required_if:bookingmoneymehtod,Nagad'],
            'nagadnumber'           =>  ['required_if:bookingmoneymehtod,Nagad'],
            'rockettransiction'     =>  ['required_if:bookingmoneymehtod,rocket'],
            'rocketnumber'          =>  ['required_if:bookingmoneymehtod,rocket'],         
           ], $message = [
            'bookingmoneymehtod.required'       =>   'টাকা পাঠানোর মাধ্যমে নির্বাচন করুন',
            'bookingmoneymehtod.not_in'         =>   'এই ঘরটি অবশ্যই পূরণ করুন',
            'bkashtransiction.required_if'      =>   'এই ঘরটি অবশ্যই পূরণ করুন',
            'bkashnumber.required_if'           =>   'এই ঘরটি অবশ্যই পূরণ করুন',
            'nagadtransiction.required_if'      =>   'এই ঘরটি অবশ্যই পূরণ করুন',
            'nagadnumber.required_if'           =>   'এই ঘরটি অবশ্যই পূরণ করুন',
            'rockettransiction.required_if'     =>   'এই ঘরটি অবশ্যই পূরণ করুন',
            'rocketnumber.required_if'          =>   'এই ঘরটি অবশ্যই পূরণ করুন',
           ]);

           $cash = new SignupCash;

            $cash->userid                  =   $request->userid;
            $cash->refereluser             =   $request->refereluser;
            $cash->bookingmoneymehtod      =   $request->bookingmoneymehtod;
            $cash->bkashtransiction        =   $request->bkashtransiction;
            $cash->bkashnumber             =   $request->bkashnumber;
            $cash->nagadtransiction        =   $request->nagadtransiction;
            $cash->nagadnumber             =   $request->nagadnumber;
            $cash->rockettransiction       =   $request->rockettransiction;
            $cash->rocketnumber            =   $request->rocketnumber;

            $cash->save();

            $totalval = TotalAmount::find(1);
            $AddAmount = $totalval->foundationfund + 171;
            $totalval->foundationfund = $AddAmount;
            $totalval->save();

            $user = User::where('id', $request->refereluser)->get();
            Notification::send($user, new Signupcashpayment($cash));

            $newuser = User::where('id', $request->userid)->get();
            Notification::send($newuser, new Signupcashpayment($cash));

            $admin = User::where('auth_role', 3)->get();
            Notification::send($admin, new Signupcashpayment($cash));


            return response()->json(['success' =>true, 'message'=> 'আপনার পেমেন্ট সম্পন্ন হয়েছে!!!']);


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
