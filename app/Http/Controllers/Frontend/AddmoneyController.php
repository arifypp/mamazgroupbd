<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Addmoney;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use CoreProc\WalletPlus\Models\WalletType;
use Response;
use DB;
use Session;
class AddmoneyController extends Controller
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
        return view('Frontend.user.pages.addmoney.create');
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
            'amount'                =>  ['required','min:3'],
            'bookingmoneymehtod'    =>  ['required', 'not_in:0'],
            'bkashtransiction'      =>  ['required_if:bookingmoneymehtod,bkash'],
            'bkashnumber'           =>  ['required_if:bookingmoneymehtod,bkash'],
            'nagadtransiction'      =>  ['required_if:bookingmoneymehtod,Nagad'],
            'nagadnumber'           =>  ['required_if:bookingmoneymehtod,Nagad'],
            'rockettransiction'     =>  ['required_if:bookingmoneymehtod,rocket'],
            'rocketnumber'          =>  ['required_if:bookingmoneymehtod,rocket'],
        ],
        $message = [
            'amount.required'               =>  'দয়া করে টাকার পরিমাণ বসান।',
            'bookingmoneymehtod.required'   =>  'টাকার মাধ্যম পছন্দ করুন।',
            'bookingmoneymehtod.not_in'     =>  'টাকার মাধ্যম পছন্দ করুন।',
            'bkashtransiction.required_if'  =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'bkashnumber.required_if'       =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'nagadtransiction.required_if'  =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'nagadnumber.required_if'       =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'rockettransiction.required_if' =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'rocketnumber.required_if'      =>  'তথ্যটি পূরণ করা আবশ্যক।',
        ]);
        
        
        $moneyadd = new Addmoney;

        $moneyadd->auth_id                   =  $request->auth_id;
        $moneyadd->amount                   =   $request->amount;
        $moneyadd->bookingmoneymehtod       =   $request->bookingmoneymehtod;
        $moneyadd->bkashtransiction         =   $request->bkashtransiction;
        $moneyadd->bkashnumber              =   $request->bkashnumber;
        $moneyadd->nagadtransiction         =   $request->nagadtransiction;
        $moneyadd->nagadnumber              =   $request->nagadnumber;
        $moneyadd->rockettransiction        =   $request->rockettransiction;
        $moneyadd->rocketnumber             =   $request->rocketnumber;
        
        $moneyadd->save();
        
       
        $user = User::find( $request->auth_id );

        // $wallet = $user->wallets()->create();

        // $wallet->incrementBalance($request->amount);

        $pesoWallet = $user->wallet('Peso Wallet'); 
        $pesoWallet->incrementBalance($request->amount);

        $pesoWallet->balance; 

        // $walletType = WalletType::create([
        //     'name' => 'Peso Wallet',
        //     'decimals' => 0, // Set how many decimal points your wallet accepts here. Defaults to 0.
        // ]);
        
        // $user->wallets()->create(['wallet_type_id' => $walletType->id]);


        $notification = array(
            'message'       => 'পেমেন্ট পাঠানো সম্পন্ন হয়েছে!!!',
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
