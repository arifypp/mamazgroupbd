<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\Frontend\Addmoney;
use App\Notifications\AddmoneyApproveNotification;
use App\Models\User;
use App\Models\Backend\BonusSettings;
use App\Http\Requests\BonusSettingsClass;
use CoreProc\WalletPlus\Models\WalletType;
use Auth;
use Session;

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
        return view('Backend.dashboard');

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
            'message'       => 'ডাটা আপডেটেড সাকসেসফুল!!!',
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
            'name.required'             =>  'তথ্যটি পূরণ করুন।',
            'defaultvalue.required'     =>  'তথ্যটি পূরণ করুন।',
            'bonustype.not_in'          =>  'তথ্যটি পূরণ করুন।',
        ]);


        $newbonus = new BonusSettings;

        $newbonus->name             =   $request->name;
        $newbonus->value            =   $request->defaultvalue;

        $newbonus->save();

        $notification = array(
            'message'       => 'ডাটা তৈরি সম্পন্ন হয়েছে!!!',
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
