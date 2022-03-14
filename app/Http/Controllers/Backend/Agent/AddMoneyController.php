<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Notifications\AddmoneyNotification;
use App\Notifications\Agent\MoneyApprovedNotification;
use App\Models\Frontend\Addmoney;
use CoreProc\WalletPlus\Models\WalletType;
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

    // User money request 
    public function userrequest()
    {
        $money = Addmoney::orderBy('id', 'desc')->get();
        return view('Backend.Agent.pages.addmoney.request', compact('money'));
    }

    // User request accept 
    public function userrequestaccept(Request $request, $id)
    {
        $moneaccept = Addmoney::find($id);
        if( $moneaccept->status == 1)
        {
            $notification = array(
                'message'       => 'Already Approved!!!',
                'alert-type'    => 'error'
            );
            return back()->with($notification);
        }

        // Payment accept and decrease amount from current balance 

        $user = User::find( $request->auth_user );

        // Check if nice balance
        $agentBalance = auth()->user()->wallet('Mamaz Money');
        
        $findwallelt = WalletType::where("name", "=", "Mamaz Money")->get();
        $walletidrequest = $findwallelt['0']->id;

        if( $agentBalance->balance <=  $moneaccept->amount/100)
        {
            $notification = array(
                'message'       => 'আপনার ওয়ালেটে পর্যাপ্ত টাকা নেই!!!',
                'alert-type'    => 'warning'
            );
            return back()->with($notification);
        }


        if( empty( $user->wallets()->wallet_type_id )  )
        {
            $user->wallets()->create(['wallet_type_id' => $walletidrequest]);
            // Add payment
            $admoneydeposit = $user->wallet('Mamaz Money');
            $admoneydeposit->incrementBalance($moneaccept->amount/100);
            $admoneydeposit->balance;

            $AgentDcrease = auth()->user()->wallet('Mamaz Money');
            $AgentDcrease->decrementBalance($moneaccept->amount/100);
            $AgentDcrease->balance;
        }
        else
        {
            $CashMoney = $user->wallet('Mamaz Money');
            $CashMoney->incrementBalance($moneaccept->amount/100);
            $CashMoney->balance;

            // Decrease money 
            $AgentDcrease = auth()->user()->wallet('Mamaz Money');
            $AgentDcrease->decrementBalance($moneaccept->amount/100);
            $AgentDcrease->balance;
        }

        $moneaccept->status =   1;
        $moneaccept->save();

        Notification::send($user, new MoneyApprovedNotification($moneaccept));

        $notification = array(
            'message'       => 'রিকুয়েস্ট এ্যাপ্রুভ হয়েছে এবং পেমেন্ট পাঠানো সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );
        return back()->with($notification);

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

    // Notification read 
    public function readnotify(Request $request, $id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if($notification) {
            $notification->markAsRead();
        }
        return response()->json(['success' =>true, 'message'=> 'mark as read!!!']);
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
        $delete = Addmoney::where('id', $id)->delete();

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
