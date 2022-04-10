<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Addmoney;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\Agent\MoneyRequestNotification;
use CoreProc\WalletPlus\Models\WalletType;
use App\Models\Transaction;
use App\Notifications\WithdrawAccept;
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
        $withdrawrequest = Transaction::where('status', 0)->get();
        return view('Backend.withdraw.pending', compact('withdrawrequest'));
    }

    public function requestAccept(Request $request, $id)
    {
        $withdrawaccpet = Transaction::find($id);

        $withdrawaccpet->status = '1';

        $user = $withdrawaccpet->is_user;
        
        // Check if nice balance
        $userAmount = WalletType::find($withdrawaccpet->wallet_id);
         
        if( empty( auth()->user()->wallets()->wallet_type_id )  )
        {
            auth()->user()->wallets()->create(['wallet_type_id' => $withdrawaccpet->wallet_id]);
            // Add payment
            $admoneydeposit = auth()->user()->wallet($userAmount->name);
            $admoneydeposit->incrementBalance($withdrawaccpet->amount);
            $admoneydeposit->balance;
        }
        else
        {
            $CashMoney = auth()->user()->wallet($userAmount->name);
            $CashMoney->incrementBalance($withdrawaccpet->amount);
            $CashMoney->balance;
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
    public function accept()
    {
        //
        $withdrawaccept = Transaction::where('status', 1)->get();
        return view('Backend.withdraw.accept', compact('withdrawaccept'));
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
