<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Backend\PromoteLevel;
use App\Models\Backend\TargetMessage;
use Response;
use DB;
use Session;

class PromoteLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $promote = PromoteLevel::orderby('id', 'desc')->get();
        return view('Backend.promote.manage', compact('promote'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $promoteLevel = PromoteLevel::orderby('id', 'desc')->get();
        $Promotemessage = TargetMessage::orderby('id', 'desc')->get();
        return view('Backend.promote.message', compact('Promotemessage', 'promoteLevel'));
    }

    public function storemessage(Request $request)
    {
        $request->validate([
            'promotemessage'        =>  ['required'],
            'levelname'             =>  ['required', 'not_in:0'],
        ],
        $message = [
            'promotemessage.required'   =>  'এই ঘরটি পূরণ করুন',
            'levelname.required'        =>  'নিবার্চন করুন',
            'levelname.not_in'          =>  'নিবার্চন করুন',
        ]);
      
        $Promotemessage = TargetMessage::create([
            'name'              =>  $request->promotemessage,
            'levels_id'         =>  $request->levelname,
            'status'            =>  "0",
        ]);
        

        $notification = array(
            'message'       => 'মেসেজ তৈরি করা সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );
        return back()->with($notification);


    }

    public function destroymessage($id)
    {
        $delete = TargetMessage::where('id', $id)->delete();

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


    public function fetchmessage(Request $request)
    {
        $data = TargetMessage::where("levels_id", $request->levels_id)->get(['name', 'levels_id']);
        return response()->json($data);
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
            'promotename' => 'required',
            'promoteshortname' => 'required',
        ],
        $message = [
            'promotename.required'   =>  'এই ঘরটি পূরণ করুন',
            'promoteshortname.required'   =>  'এই ঘরটি পূরণ করুন',
        ]);


        $walletType = PromoteLevel::create([
            'name' => $request->promotename,
            'shortfom'  =>  $request->promoteshortname,
        ]);

        $notification = array(
            'message'       => 'নতুন লেভেল তৈরি হয়েছে!!!',
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
        $delete = PromoteLevel::where('id', $id)->delete();

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
