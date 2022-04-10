<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Depositor;
use App\Models\User;
use CoreProc\WalletPlus\Models\WalletType;
use Auth;

class DepositController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $deposit = Depositor::orderBy('id', 'desc')->get();
        return view('Backend.deposit.manage', compact('deposit'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Backend.deposit.create');
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
            'amount'    =>  ['required'],
            'walletype' =>  ['required', 'not_in:0'],
            'desc'      =>  ['required'],
        ], $message = [
            'amount.required'   =>  'সঠিক এমাউন্ট বসান',
            'walletype.required'   =>  'ওয়ালেট নির্বাচন করুন',
            'walletype.not_in'   =>  'ওয়ালেট নির্বাচন করুন',
            'desc.required'     =>  'বিবরণ লিখুন।',
        ]);

        $deposit = new Depositor;

        $deposit->txn_id        =   time();
        $deposit->purpose       =   $request->desc;
        $deposit->amount        =   $request->amount;
        $deposit->wallet_id     =   $request->walletype;
        $deposit->user_id       =   Auth::user()->id;

        $deposit->save();

        $user = User::where('id', $deposit->user_id)->first();

        $agentBalance = $user->wallet('Cash Money');
        
        $findwallelt = WalletType::where("name", "=", "Cash Money")->get();
        $walletidrequest = $findwallelt['0']->id;

        if( $agentBalance->balance <=  $deposit->amount)
        {
            Depositor::where('id', $deposit->id)->delete();
            $notification = array(
                'message'       => 'আপনার ওয়ালেটে পর্যাপ্ত টাকা নেই!!!',
                'alert-type'    => 'warning'
            );
            return back()->with($notification);
        }

        if( empty( $user->wallets()->wallet_type_id )  )
        {
            // Decrease money 
            $AgentDcrease = $user->wallet('Cash Money');
            $AgentDcrease->decrementBalance($deposit->amount);
            $AgentDcrease->balance;
        }
        else
        {
            // Decrease money 
            $AgentDcrease = $user->wallet('Cash Money');
            $AgentDcrease->decrementBalance($deposit->amount);
            $AgentDcrease->balance;
        }

        $notification = array(
            'message'       => 'ডাটা তৈরি সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success',
        );

        return redirect()->route('deposit.manage')->with($notification);
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
