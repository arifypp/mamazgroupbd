<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Report;
use Illuminate\Support\Facades\Notification;
use Response;
use DB;
use Session;
class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Frontend.user.pages.report.manage');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Frontend.user.pages.report.create');
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
            'date'              =>  ['required'],
            'name'              =>  ['required'],
            'phone'             =>  ['required'],
            'email'             =>  ['required'],
            'invitedate'        =>  ['required'],
            'officevisitdate'   =>  ['required'],
            'sidevisitdate'     =>  ['required'],
            'counsiling'        =>  ['required'],
            'targetfee'         =>  ['required', 'not_in:0'],
            'hwant'             =>  ['required'],
            'bthink'            =>  ['required'],
            'mishuk'            =>  ['required'],
            'planshow'          =>  ['required'],
            'training'          =>  ['required'],
            'problem'           =>  ['required'],
            'comment'           =>  ['required'],
        ],
        $message = [
            'name.required' => 'নাম লিখুন',
            'date.required' => 'তারিখ নির্বাচন করুন',
        ]);
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
