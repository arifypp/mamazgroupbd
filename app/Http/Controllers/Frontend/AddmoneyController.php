<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\Addmoney;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Notifications\Agent\MoneyRequestNotification;
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

    // find agent user
    public function findagent(Request $request)
    {
        $data = User::orderby('name','asc')->select('id','name', 'username', 'auth_role')->where('name', 'like', '%' .$request->agentusers . '%')->orWhere('username', 'like', '%' .$request->agentusers . '%')->where('auth_role', 1)->limit(5)->get();
        
        return ['results' => $data];
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
            'agent_id'              =>  ['required', 'not_in:0'],
            'bookingmoneymehtod'    =>  ['required', 'not_in:0'],
            'bkashtransiction'      =>  ['required_if:bookingmoneymehtod,bkash'],
            'bkashnumber'           =>  ['required_if:bookingmoneymehtod,bkash'],
            'nagadtransiction'      =>  ['required_if:bookingmoneymehtod,Nagad'],
            'nagadnumber'           =>  ['required_if:bookingmoneymehtod,Nagad'],
            'rockettransiction'     =>  ['required_if:bookingmoneymehtod,rocket'],
            'rocketnumber'          =>  ['required_if:bookingmoneymehtod,rocket'],
        ],
        $message = [
            'amount.required'               =>  'অনুগ্রহ করে টাকার পরিমাণ বসান।',
            'bookingmoneymehtod.required'   =>  'টাকার মাধ্যম পছন্দ করুন।',
            'bookingmoneymehtod.not_in'     =>  'টাকার মাধ্যম পছন্দ করুন।',
            'agent_id.not_in'               =>  'এজেন্ট নির্বাচন করুন।',
            'bkashtransiction.required_if'  =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'bkashnumber.required_if'       =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'nagadtransiction.required_if'  =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'nagadnumber.required_if'       =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'rockettransiction.required_if' =>  'তথ্যটি পূরণ করা আবশ্যক।',
            'rocketnumber.required_if'      =>  'তথ্যটি পূরণ করা আবশ্যক।',
        ]);
        
        
        $moneyadd = new Addmoney;

        $moneyadd->auth_id                  =   $request->auth_id;
        $moneyadd->agent_id                 =   $request->agent_id;
        $moneyadd->amount                   =   $request->amount;
        $moneyadd->bookingmoneymehtod       =   $request->bookingmoneymehtod;
        $moneyadd->bkashtransiction         =   $request->bkashtransiction;
        $moneyadd->bkashnumber              =   $request->bkashnumber;
        $moneyadd->nagadtransiction         =   $request->nagadtransiction;
        $moneyadd->nagadnumber              =   $request->nagadnumber;
        $moneyadd->rockettransiction        =   $request->rockettransiction;
        $moneyadd->rocketnumber             =   $request->rocketnumber;
        
        $moneyadd->save();
        
        // Notitification here 
        $authenticate = User::where('id', $moneyadd->agent_id)->get();
        Notification::send($authenticate, new MoneyRequestNotification($moneyadd));

        $notification = array(
            'message'       => 'রিকুয়েস্ট পাঠানো সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );
        return back()->with($notification);

    }

    /**
     * Transfer Money
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function transfer(Request $request)
    {
        // $request->validate([
        //     'sendto'        =>  ['required'],
        // ],
    
        // $message = [
        //     'sendto.required'    =>  'Checkking',
        // ]);

        
        $user = User::find( $request->auth_id );

        $findwallelt = WalletType::where("name", "=", $request->sendto)->get();
        $walletidrequest = $findwallelt['0']->id;

        if( empty( $user->wallets()->wallet_type_id )  )
        {
            $user->wallets()->create(['wallet_type_id' => $walletidrequest]);
        }

        // Increase money 
        if( $request->sendto == "Mamaz Money") 
        {
            $requesttaka = $request->amount;

            $mamaztaka = $requesttaka/100;

            $pesoWallet = $user->wallet($request->sendto);
            $pesoWallet->incrementBalance($mamaztaka);
            $pesoWallet->balance;

            // Decrease money 
            $CashMoney = $user->wallet('Cash Money');
            $CashMoney->decrementBalance($request->amount);
            $CashMoney->balance;

            $notification = array(
                'message'       => 'আপনার টাকা ' .$request->sendto. ' তে ট্রান্সফার সম্পন্ন হয়েছে।',
                'alert-type'    => 'success'
            );

            return back()->with($notification);

        }

        $pesoWallet = $user->wallet($request->sendto);
        $pesoWallet->incrementBalance($request->amount);
        $pesoWallet->balance;

        // Decrease money 
        $CashMoney = $user->wallet('Cash Money');
        $CashMoney->decrementBalance($request->amount);
        $CashMoney->balance;

        $notification = array(
            'message'       => 'আপনার টাকা ' .$request->sendto. ' তে ট্রান্সফার সম্পন্ন হয়েছে।',
            'alert-type'    => 'success'
        );
        return back()->with($notification);

    }

    /**
     * Transfer Agent Money
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function transferagentmoney(Request $request)
    {
        $user = User::find( $request->auth_id );

        $findwallelt = WalletType::where("name", "=", $request->sendtoag)->get();
        $walletidrequest = $findwallelt['0']->id;

        if( empty( $user->wallets()->wallet_type_id )  )
        {
            $user->wallets()->create(['wallet_type_id' => $walletidrequest]);
        }

        // Increase money 
        if( $request->sendtoag == "Mamaz Money") 
        {
            $requesttaka = $request->amount;

            $mamaztaka = $requesttaka/100;

            $pesoWallet = $user->wallet($request->sendtoag);
            $pesoWallet->incrementBalance($mamaztaka);
            $pesoWallet->balance;

            // Decrease money 
            $CashMoney = $user->wallet('Cash Money');
            $CashMoney->decrementBalance($request->amount);
            $CashMoney->balance;

            $notification = array(
                'message'       => 'আপনার টাকা ' .$request->sendtoag. ' তে ট্রান্সফার সম্পন্ন হয়েছে।',
                'alert-type'    => 'success'
            );

            return back()->with($notification);

        }

        $pesoWallet = $user->wallet($request->sendtoag);
        $pesoWallet->incrementBalance($request->amount);
        $pesoWallet->balance;

        // Decrease money 
        $CashMoney = $user->wallet('Agent Money');
        $CashMoney->decrementBalance($request->amount);
        $CashMoney->balance;

        $notification = array(
            'message'       => 'আপনার টাকা ' .$request->sendtoag. ' তে ট্রান্সফার সম্পন্ন হয়েছে।',
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
        
    }
}
