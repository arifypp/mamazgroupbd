<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddmoneyNotification;
use App\Models\Frontend\Addmoney;
use App\Models\User;
use Auth;
use Session;

class AddMoneyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $money = Addmoney::orderBy('id', 'desc')->where('auth_id', Auth::user()->id)->get();
        return view('Backend.Agent.pages.addmoney.manage', compact('money'));

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
            'amount'            =>  ['required', 'min:3', 'numeric'],
            'paymentmethod'     =>  ['required', 'not_in:0'],
            'banktransiction'   =>  ['required_if:paymentmethod,bankcash'],
        ], 
        $message = [
            'amount.required'               =>  'টাকার পরিমান বসান।',
            'amount.max'                    =>  'টাকার পরিমান বসান।',
            'amount.numeric'               =>  'টাকার পরিমান বসান।',
            'paymentmethod.required'        =>  'টাকা পাঠানোর মাধ্যম নির্বাচন করুন।',
            'paymentmethod.not_in'          =>  'টাকা পাঠানোর মাধ্যম নির্বাচন করুন।',
            'banktransiction.required_if'   =>  'সঠিক রিসিপ নাম্বার দিন।',
        ]);
        
        $addMoney = new Addmoney;

        $addMoney->auth_id              =  $request->user;
        $addMoney->amount               =  $request->amount;
        $addMoney->amount               =  $request->amount;
        $addMoney->bookingmoneymehtod   =  $request->paymentmethod;
        $addMoney->banktransaction      =  $request->banktransiction;
        $addMoney->status               =   0;

        $addMoney->save();

        $admin = User::where('auth_role', 3)->get();
        Notification::send($admin, new AddmoneyNotification($addMoney));

        $notification = array(
            'message'       => 'ডাটা পাঠানো সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );
        return back()->with($notification);

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
