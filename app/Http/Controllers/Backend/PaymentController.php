<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Frontend\Addmoney;
use App\Notifications\AddmoneyApproveNotification;
use App\Models\User;
use CoreProc\WalletPlus\Models\WalletType;
use Auth;
use Session;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $money = Addmoney::orderBy('id', 'desc')->where('status', 0)->get();
        return view('Backend.paymentrequest.manage', compact('money'));
    }

    public function approve()
    {
        //
        $money = Addmoney::orderBy('id', 'desc')->where('status', 1)->get();
        return view('Backend.paymentrequest.approved', compact('money'));
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
        $moneyUpdate = Addmoney::find($id);
        $moneyUpdate->status =  1; //approve request
        $moneyUpdate->save();

        $user = User::find( $request->auth_user );

        $findwallelt = WalletType::where("name", "=", "Mamaz Money")->get();
        $walletidrequest = $findwallelt['0']->id;

        if( empty( $user->wallets()->wallet_type_id )  )
        {
            $user->wallets()->create(['wallet_type_id' => $walletidrequest]);

            $admoneydeposit = $user->wallet('Mamaz Money');
            $admoneydeposit->incrementBalance($moneyUpdate->amount/100);
            $admoneydeposit->balance;
        }
        else
        {
            $CashMoney = $user->wallet('Mamaz Money');
            $CashMoney->incrementBalance($moneyUpdate->amount/100);
            $CashMoney->balance;
        }

        $userRequest = User::where('id', $moneyUpdate->auth_id)->get();
        Notification::send($userRequest, new AddmoneyApproveNotification($moneyUpdate));

        $notification = array(
            'message'       => 'রিকুয়েস্ট এ্যাপ্রুভ হয়েছে এবং পেমেন্ট পাঠানো সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );
        return back()->with($notification);


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
