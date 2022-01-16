<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Landcat;
use DB;
use Session;

class LandcatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Backend.landcat.manage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Backend.landcat.create');
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
            'landvalue'         =>  ['required'],
            'landprice'         =>  ['required'],
            'status'            =>  ['required', 'not_in:0'],
            'comment'           =>  ['required'],
        ],
        $message = [
            'landvalue.required' => 'জমির পরিমাণ লিখুন',
            'landprice.required' => 'জমির মুল্য লিখুন',
            'status.required' => 'জমির স্টাটার্স নির্বাচন করুন',
            'status.not_in' => 'জমির সাস্টার্স নির্বাচন করুন',
            'comment.required' => 'জমির পরিমাণ লিখুন',           
        ]);

        $landcat  = new Landcat;

        $landcat->landvalue     =   $request->landvalue;
        $landcat->landprice     =   $request->landprice;
        $landcat->status        =   $request->status;
        $landcat->comment       =   $request->comment;

        $landcat->save();

        $notification = array(
            'message'       => 'জমি তৈরি করা সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('landcat.manage')->with($notification);

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
