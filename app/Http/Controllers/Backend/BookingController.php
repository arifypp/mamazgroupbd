<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use lemonpatwari\bangladeshgeocode\Models\Division;
use App\Models\Frontend\Booking;
use App\Models\User;
use App\Notifications\BookingNotification;
use Illuminate\Support\Facades\Notification;
use Response;
use DB;
use Session;
class BookingController extends Controller
{
    /**
     * Total Booking
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Backend.booking.manage');
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
        return view('Backend.booking.new', compact('bookings'));

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
