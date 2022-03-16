<?php

namespace App\Http\Controllers\Backend\Agent;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Report;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\Agent\ReportApprovedNotification;
use Response;
use DB;
use Session;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $report = Report::all();
        return view('Backend.Agent.pages.reports.pending', compact('report'));
    }

    public function approved()
    {
        $report = Report::all();        
        return view('Backend.Agent.pages.reports.approved', compact('report'));
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
        $report = Report::find($id);
        if( !empty($report) )
        {
            return view('Backend.Agent.pages.reports.show', compact('report'));
        }
        else
        {
            $notification = array(
                'message'       => 'ডাটা পাওয়া যায়নি!!!',
                'alert-type'    => 'error'
            );    
            return back()->with($notification);
        }
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
        $reports = Report::find($id);


        if( !is_null($reports) ){
            if($reports->status == 0){
                $reports->status    =   1;
                $reports->save();

                $applicantID = User::where('id', $reports->userid)->get();
                Notification::send($applicantID, new ReportApprovedNotification($reports));

                return response()->json(['success' =>true, 'message'=> 'রিপোর্ট এপ্রুভ করা হয়েছে!!!']);
            }
            else{
                return response()->json(['success' =>true, 'message'=> 'রিপোর্ট পূর্বেই এপ্রুভ করা হয়েছে!!!']);
            }
        }
        else
        {
            $notification = array(
                'message'       => 'Data not found!!!',
                'alert-type'    => 'success'
            );
    
            return back()->with($notification);
        }
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
        $delete = Report::where('id', $id)->delete();

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
