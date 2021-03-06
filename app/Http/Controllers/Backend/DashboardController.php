<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Frontend\Addmoney;
use App\Notifications\AddmoneyApproveNotification;
use App\Models\User;
use App\Models\Frontend\WalletsLadger;
use App\Models\Backend\BonusSettings;
use App\Http\Requests\BonusSettingsClass;
use CoreProc\WalletPlus\Models\WalletType;
use Auth;
use Session;
use DB;
class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth','verified']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $year = date('Y');

        $current = '';
        $previous = '';
        
        for ($i = 0; $i < 12; $i++) {
            $start_date = date("Y-m-d", strtotime( date( 'Y-01-01' )." $i months"));
            $end_date   = date("Y-m-t", strtotime($start_date));

            $currentData =  WalletsLadger::getCountVisitor($start_date, $end_date);
            $current .= $currentData.',';

            $previous_start_date = date("Y-m-d", strtotime("-1 year", strtotime($start_date)));
            $previous_end_date = date("Y-m-t", strtotime($previous_start_date));


            $previousData =  WalletsLadger::getCountVisitor($previous_start_date, $previous_end_date);
            $previous .= $previousData.',';

        }

        $data['current'] = rtrim($current,',');
        $data['previous'] = rtrim($previous,',');

        return view('Backend.dashboard', compact('data'));

    }

    // Notification seen 
    public function notify(Request $request, $id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if($notification) {
            $notification->markAsRead();
        }
        return response()->json(['success' =>true, 'message'=> 'mark as read!!!']);
    }

    // Bonus settings
    public function bonus()
    {
        return view('Backend.settings.bonus');
    }

    public function bonusSetPost(BonusSettingsClass $request)
    {
        $collection = collect($request->validated());
        
            foreach ($collection->all() as $key => $value) {
                BonusSettings::set($key, $value);
            }

        
        $notification = array(
            'message'       => '???????????? ????????????????????? ???????????????????????????!!!',
            'alert-type'    => 'success',
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
        return view('Backend.settings.addbonus');
    }

    public function profile($username)
    {
        $user   = User::where('username', $username)->first();
        return view('Backend.profile', compact('user'));

    }

    public function report()
    {
        $ledgers = DB::table('wallets')->get();

        foreach( $ledgers as $ledger )
        {
            $walletledger = DB::table('wallet_ledgers')->where('wallet_id', $ledger->id)->get();
            return view('Backend.report', compact('walletledger', 'ledger'));
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
            'name'          =>  ['required', 'string'],
            'defaultvalue'  =>  ['required', 'string'],
            'bonustype'     =>  ['required', 'not_in:0'],
        ],
        $message = [
            'name.required'             =>  '?????????????????? ???????????? ???????????????',
            'defaultvalue.required'     =>  '?????????????????? ???????????? ???????????????',
            'bonustype.not_in'          =>  '?????????????????? ???????????? ???????????????',
        ]);


        $newbonus = new BonusSettings;

        $newbonus->name             =   $request->name;
        $newbonus->value            =   $request->defaultvalue;

        $newbonus->save();

        $notification = array(
            'message'       => '???????????? ???????????? ????????????????????? ???????????????!!!',
            'alert-type'    => 'success',
        );

        return back()->with($notification);

    }

    public function referellist()
    {
        $user = User::all();
        if( $user )
        {
            return view('Backend.userlist', compact('user'));
        }

    }

    public function refereladmin($referrer_id)
    {
        $user = User::where('referrer_id', $referrer_id)->get();

        if( $user )
        {
            return view('Backend.refuserlist', compact('user'));
        }
    }

    public function fundation(Request $request)
    {
        $request->validate([
            'amount'            =>   ['required'],
            'wallet_type'       =>   ['required', 'not_in:0'],
            'receiver_id'       =>  ['required', 'not_in:0'],
        ]);

        $amount = $request->amount;
        $admin_id = User::where('auth_role', 3)->first();
        $admin = User::find($admin_id->id);
        $user = User::find($request->receiver_id);

        $cashmoney = WalletType::find($request->wallet_type);
        $fundationmoney = WalletType::find(33);

        if( empty( $user->wallets()->wallet_type_id ) || empty( $admin->wallets()->wallet_type_id ) )
        {
            $user->wallets()->create(['wallet_type_id' => $cashmoney->id]);
            $admin->wallets()->create(['wallet_type_id' => $fundationmoney->id]);

            // User payment increment
            $usercashincrement = $user->wallet('Cash Money');
            $usercashincrement->incrementBalance($amount);
            $usercashincrement->balance;

            // Decrement payment
            $admincashincrement = $admin->wallet('Fundation Bonus');
            $admincashincrement->decrementBalance($amount);
            $admincashincrement->balance;            
        }
        else
        {
            // User payment increment
            $usercashincrement = $user->wallet('Cash Money');
            $usercashincrement->incrementBalance($amount);
            $usercashincrement->balance;

            // Decrement payment
            $admincashincrement = $admin->wallet('Fundation Bonus');
            $admincashincrement->decrementBalance($amount);
            $admincashincrement->balance;
        }

        $notification = array(
            'message'       => '????????????????????? ????????????????????? ???????????????!!!',
            'alert-type'    => 'success',
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
