<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Frontend\Addmoney;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\Agent\MoneyRequestNotification;
use CoreProc\WalletPlus\Models\WalletType;
use App\Models\Transaction;
use Response;
use DB;
use Session;
use Auth;
class TransactionController extends Controller
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
        return view('Frontend.user.pages.widthdraw');

    }

    // neeed to know price
    public function needtoknowamount($id)
    {
               
        $userAmount = WalletType::find($id);

        $MamzPerformance = auth()->user()->wallet($userAmount->id);

            if( !empty( $MamzPerformance->balance ) ){
                $amount = $MamzPerformance->balance; 
                return response()->json($amount);
            }
            else
            {
                return '0';
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
        $request->validate([
            'inlineRadioOptions'    =>  ['required'],
            'agent_id'          =>  ['required_with:inlineRadioOptions,agentPayment'],
            'amount'            =>  ['required'],
            'wallet_type'       =>  ['required', 'not_in:0'],
        ],
        $message = [
            'inlineRadioOptions.required'   =>  'উইথড্রো অপশন নির্বাচন করুন',
            'agent_id.required'         =>  'তথ্যটি পূরণ করা আবশ্যক?',
            'agent_id.not_in'           =>  'তথ্যটি পূরণ করা আবশ্যক?',
            'amount.required'           =>  'তথ্যটি পূরণ করা আবশ্যক?',
            'wallet_type.required'      =>  'তথ্যটি পূরণ করা আবশ্যক?',
            'wallet_type.not_in'        =>  'তথ্যটি পূরণ করা আবশ্যক?',
        ]);

        $user = User::where('auth_role', '3')->first();
        // Check if nice balance
        $userAmount = WalletType::find($request->wallet_type);

        $Withdrawrequestwallettaka = auth()->user()->wallet($userAmount->id);

        $authorcash = $user->wallet($userAmount->id);

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
        
        if( $request->inlineRadioOptions == 'AdminPayment' )
        {
            $withdraw = new Transaction;

            $withdraw->payment_id       =   rand('0', '10000000');
            $withdraw->txn_id           =   time() . '-' . Auth::user()->id;
            $withdraw->status           =   '0';
            $withdraw->amount           =   $totalamount;
            $withdraw->network_fee      =   config('bonus_settings.withdrawcharge');
            $withdraw->wallet_id        =   $request->wallet_type;
            $withdraw->user_id          =   $request->auth_id;

            $withdraw->save();

            if( empty( $user->wallets()->wallet_type_id )  )
            {
                $user->wallets()->create(['wallet_type_id' => $withdraw->wallet_id]);
                // Add payment
                $admoneydeposit = $user->wallet($userAmount->name);
                $admoneydeposit->incrementBalance($withdraw->amount);
                $admoneydeposit->balance;

                $AgentDcrease = auth()->user()->wallet($userAmount->name);
                $AgentDcrease->decrementBalance($withdraw->amount);
                $AgentDcrease->balance;
            }
            else
            {
                $CashMoney = $user->wallet($userAmount->name);
                $CashMoney->incrementBalance($withdraw->amount);
                $CashMoney->balance;

                // Decrease money 
                $AgentDcrease = auth()->user()->wallet($userAmount->name);
                $AgentDcrease->decrementBalance($withdraw->amount);
                $AgentDcrease->balance;
            }

            $notification = array(
                'message'       => 'উইথড্রো সম্পন্ন হয়েছে!!!',
                'alert-type'    => 'success'
            );
            return back()->with($notification);


        }
        else if( $request->inlineRadioOptions == 'agentPayment' )
        {
            $withdraw = new Transaction;

            $withdraw->payment_id       =   rand('0', '10000000');
            $withdraw->txn_id           =   time() . '-' . Auth::user()->id;
            $withdraw->status           =   '0';
            $withdraw->amount           =   $totalamount;
            $withdraw->network_fee      =   config('bonus_settings.withdrawcharge');
            $withdraw->wallet_id        =   $request->wallet_type;
            $withdraw->user_id          =   $request->auth_id;

            $withdraw->save();

            if( empty( $user->wallets()->wallet_type_id )  )
            {
                $user->wallets()->create(['wallet_type_id' => $withdraw->wallet_id]);
                // Add payment
                $admoneydeposit = $user->wallet($userAmount->name);
                $admoneydeposit->incrementBalance($withdraw->amount);
                $admoneydeposit->balance;

                $AgentDcrease = auth()->user()->wallet($userAmount->name);
                $AgentDcrease->decrementBalance($withdraw->amount);
                $AgentDcrease->balance;
            }
            else
            {
                $CashMoney = $user->wallet($userAmount->name);
                $CashMoney->incrementBalance($withdraw->amount);
                $CashMoney->balance;

                // Decrease money 
                $AgentDcrease = auth()->user()->wallet($userAmount->name);
                $AgentDcrease->decrementBalance($withdraw->amount);
                $AgentDcrease->balance;
            }

            $notification = array(
                'message'       => 'উইথড্রো সম্পন্ন হয়েছে!!!',
                'alert-type'    => 'success'
            );
            return back()->with($notification);
        }
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
