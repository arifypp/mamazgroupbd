<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use lemonpatwari\bangladeshgeocode\Models\Division;
use App\Models\Frontend\Booking;
use App\Models\User;
use App\Notifications\BookingNotification;
use App\Notifications\BookingApproveNotification;
use Illuminate\Support\Facades\Notification;
use Response;
use DB;
use Session;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $bookings = Booking::orderBy('id', 'desc')->where('status', 3)->get();
        return view('Backend.Agent.pages.booking.manage', compact('bookings'));
    }

    /**
     * New Booking
     *
     * @return \Illuminate\Http\Response
     */
    public function new()
    {
        // 
        $bookings = Booking::where('status', 0)->get();
        return view('Backend.Agent.pages.booking.new', compact('bookings'));

    }

    public function status(Request $request, $id)
    {
        //
        $bookings = Booking::find($id);
        $bookings->status = 3;

        $bookings->save();

        $user = User::where('id', auth()->user()->referrer_id)->get();
        Notification::send($user, new BookingApproveNotification($bookings));

        $bookinguser = User::where('id', $bookings->id)->get();
        Notification::send($bookinguser, new BookingApproveNotification($bookings));

        return response()->json(['success' =>true, 'message'=> 'বুকিং অ্যপ্রেুাভ সম্পন্ন হয়েছে!!!']);
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
        $bookings = Booking::find($id);
        return view('Backend.Agent.pages.booking.show', compact('bookings'));
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
        $divisions = Division::all();
        $booking = Booking::find($id);
        
        if( !is_null($booking) )
        {
            return view('Backend.Agent.pages.booking.edit', compact('booking', 'divisions'));
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
        $booking = Booking::find($id);

        $booking->bookingid         =   rand(0, 9999999);
        $booking->bookingauthid     =   auth()->user()->id;
        $booking->name              =   $request->name;
        $booking->phonenumber       =   $request->phonenumber;
        $booking->religion          =   $request->religion;
        $booking->nationality       =   $request->nationality;
        $booking->nidnumber         =   $request->nidnumber;
        $booking->dob               =   $request->dob;
        $booking->maritalstatus     =   $request->maritalstatus;
        $booking->fathername        =   $request->fathername;
        $booking->fatherphone       =   $request->fatherphone;
        $booking->mothername        =   $request->mothername;
        $booking->motherphone       =   $request->motherphone;
        $booking->spousename        =   $request->spousename;
        $booking->spousephonenumber =   $request->spousephonenumber;
        $booking->flatorhouse       =   $request->flatorhouse;
        $booking->divisionid        =   $request->division;
        $booking->districtid        =   $request->district;
        $booking->thanaid           =   $request->thana;
        $booking->ppostoffice       =   $request->ppostoffice;
        $booking->ppostcode         =   $request->ppostcode;
        $booking->permanenthouse    =   $request->permanenthouse;
        $booking->permanetdivisionid =   $request->permanetdivision;
        $booking->permanentdistrictid =   $request->permanentdistrict;
        $booking->permanentthanaid  =   $request->permanentthana;
        $booking->permanentpostoffice =   $request->permanentpostoffice;
        $booking->permanentpostcode =   $request->permanentpostcode;
        $booking->nominyname        =   $request->nominyname;
        $booking->nominyphone       =   $request->nominyphone;
        $booking->nominyaddress     =   $request->nominyaddress;
        $booking->nominynid         =   $request->nominynid;
        $booking->nominyrelatoin    =   $request->nominyrelatoin;
        $booking->referelname       =   $request->referelname;
        $booking->referelphone      =   $request->referelphone;
        $booking->referelemail      =   $request->referelemail;
        $booking->flatvalue         =   $request->flatvalue;
        $booking->bookingmoney      =   $request->bookingmoney;
        $booking->bookingmoneymehtod =   $request->bookingmoneymehtod;
        $booking->banktransaction   =   $request->banktransaction;
        $booking->bankreferenceno   =   $request->bankreferenceno;
        $booking->bkashtransiction  =   $request->bkashtransiction;
        $booking->bkashnumber       =   $request->bkashnumber;
        $booking->nagadtransiction  =   $request->nagadtransiction;
        $booking->nagadnumber       =   $request->nagadnumber;
        $booking->rockettransiction =   $request->rockettransiction;
        $booking->rocketnumber      =   $request->rocketnumber;

        $booking->save();

        $notification = array(
            'message'       => 'ডাটা আপডেট সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('booking.agent.manage')->with($notification);
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
        $delete = Booking::where('id', $id)->delete();

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
