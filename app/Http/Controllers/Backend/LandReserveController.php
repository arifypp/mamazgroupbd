<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\LandReserve;
use App\Models\Backend\LandReserveCat;
class LandReserveController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $landreserve  = LandReserve::orderBy('id', 'desc')->get();
        return view('Backend.landreserve.manage', compact('landreserve'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Backend.landreserve.create');
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
        
        $LandReserve = new LandReserve();

        $LandReserve->sft          =   $request->sft;
        $LandReserve->land_cat     =   $request->lcat;

        $LandReserve->save();

        $notification = array(
            'message'       => 'জমি রিজার্ভ সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('landreserve.manage')->with($notification);


    }

    public function catstore(Request $request)
    {
        $request->validate([
            'lcname'       =>   ['required'],
            'lcstatus'     =>   ['required', 'not_in:0'],
            'lcprise'      =>   ['required'],
        ], $message = [
            'lcname'                =>  'Please fill out the field!',
            'lcstatus'              =>  'Please fill out the field!',
            'lcstatus.not_in'      =>  'Please fill out the field!',
            'lcprise'               =>  'Please fill out the field!',
        ]);

        $landcat = new LandReserveCat();

        $landcat->name          =   $request->lcname;
        $landcat->status        =   $request->lcstatus;
        $landcat->price         =   $request->lcprise;

        $landcat->save();

        return response()->json(['success' =>true, 'message'=> 'ক্যাটাগরি তৈরি সম্পন্ন হয়েছে!!!']);
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
        $landreseve = LandReserve::find($id);

        if( !is_null($landreseve) )
        {
            return view('Backend.landreserve.edit', compact('landreseve'));
        }
        else{
            $notification = array(
                'message'       => 'ডাটা খুজে পাচ্ছি না!!!',
                'alert-type'    => 'warning'
            );

            return back()->with($notification);

        }
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
        $LandReserve = LandReserve::find($id);

        $LandReserve->sft          =   $request->sft;
        $LandReserve->land_cat     =   $request->lcat;

        $LandReserve->save();

        $notification = array(
            'message'       => 'জমি রিজার্ভ আপডেট হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('landreserve.manage')->with($notification);
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
        $maincat = LandReserve::where('id', $id)->get();

        foreach( $maincat as $deleteCat )
        {
            $subCatDel = LandReserveCat::where('id', $deleteCat->land_cat)->delete();
        }

        $delete = LandReserve::where('id', $id)->delete();

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
