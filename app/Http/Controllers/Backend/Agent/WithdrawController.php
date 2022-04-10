<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Addmoney;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\Agent\MoneyRequestNotification;
use CoreProc\WalletPlus\Models\WalletType;
use App\Models\Transaction;
use App\Notifications\WithdrawAccept;
use App\Notifications\WithdrawNotification;
use Response;
use DB;
use Session;
use Auth;
class WithdrawController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $withdrawrequest = Transaction::where('is_user', Auth::user()->id)->get();
        return view('Backend.Agent.pages.withdraw.pending', compact('withdrawrequest'));
    }

    public function requestAccept(Request $request, $id)
    {
        $withdrawaccpet = Transaction::find($id);

        $withdrawaccpet->status = '1';

        $user = User::where('id', Auth::user()->id)->first();
        
        // Check if nice balance
        $userAmount = WalletType::find($withdrawaccpet->wallet_id);
         
        if( empty( $user->wallets()->wallet_type_id )  )
        {
            $user->wallets()->create(['wallet_type_id' => $withdrawaccpet->wallet_id]);
            $user->wallets()->create(['wallet_type_id' => '30']);
            // Add payment
            $admoneydeposit = $user->wallet($userAmount->name);
            $admoneydeposit->incrementBalance($withdrawaccpet->amount);
            $admoneydeposit->balance;

            $servicecharge = $user->wallet('Money Request');
            $servicecharge->incrementBalance($withdrawaccpet->network_fee);
            $servicecharge->balance;

            	
        }
        else
        {
            $CashMoney = $user->wallet($userAmount->name);
            $CashMoney->incrementBalance($withdrawaccpet->amount);
            $CashMoney->balance;

            $servicecharge = $user->wallet('Money Request');
            $servicecharge->incrementBalance($withdrawaccpet->network_fee);
            $servicecharge->balance;
        }
        

        $withdrawaccpet->save();

        $requestuser = User::where('id', $withdrawaccpet->user_id)->get();
        Notification::send($requestuser, new WithdrawAccept($withdrawaccpet));

        $notification = array(
            'message'       => 'উইথড্রো টাকা একসেপট সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return back()->with($notification);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function withdraw()
    {
        //
        return view('Backend.Agent.pages.withdraw.withdraw');
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
            'amount'            =>  ['required'],
            'wallet_type'       =>  ['required', 'not_in:0'],
        ],
        $message = [
            'amount.required'           =>  'তথ্যটি পূরণ করা আবশ্যক?',
            'wallet_type.required'      =>  'তথ্যটি পূরণ করা আবশ্যক?',
            'wallet_type.not_in'        =>  'তথ্যটি পূরণ করা আবশ্যক?',
        ]);

        $user = User::where('id', Auth::user()->id)->first();

        // Check if nice balance
        $userAmount = WalletType::find($request->wallet_type);

        $Withdrawrequestwallettaka = auth()->user()->wallet($userAmount->id);

        $servicecharge = $request->amount / 100 * config('bonus_settings.withdrawcharge');

        $totalamount = $servicecharge + $request->amount;

        if( $Withdrawrequestwallettaka->balance <=  $totalamount)
        {
            $notification = array(
                'message'       => 'আপনার ওয়ালেটে পর্যাপ্ত টাকা নেই!!!',
                'alert-type'    => 'warning'
            );
            return back()->with($notification);
        }


        $withdraw = new Transaction;

        $withdraw->payment_id       =   rand('0', '10000000');
        $withdraw->txn_id           =   time() . '-' . Auth::user()->id;
        $withdraw->status           =   '0';
        $withdraw->amount           =   $totalamount;
        $withdraw->network_fee      =   config('bonus_settings.withdrawcharge');
        $withdraw->wallet_id        =   $request->wallet_type;
        $withdraw->user_id          =   Auth::user()->id;
        $withdraw->is_user          =   Auth::user()->id;
        
        $withdraw->save();

    
        // Decrease money 
        $AgentDcrease = auth()->user()->wallet($userAmount->name);
        $AgentDcrease->decrementBalance($withdraw->amount);
        $AgentDcrease->balance;
        

        $adminuser = User::where('auth_role', '3')->get();
        Notification::send($adminuser, new WithdrawNotification($withdraw));

        $notification = array(
            'message'       => 'উইথড্রো সম্পন্ন হয়েছে!!!',
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
        $withdraw = Transaction::find($id);
    if( $withdraw->status == 0 ){
        $user = User::where('id', $withdraw->user_id)->first();

        $userAmount = WalletType::find($withdraw->wallet_id);

        $AgentDcrease = $user->wallet($userAmount->name);
        $AgentDcrease->incrementBalance($withdraw->amount);
        $AgentDcrease->balance;
    }

        $delete = Transaction::where('id', $id)->delete();

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
