<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\Report;
use App\Models\User;
use Illuminate\Support\Facades\Notification;
use App\Notifications\UserReportNotification;
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
        $report = Report::where('userid', auth()->user()->id)->get();
        return view('Frontend.user.pages.report.manage', compact('report'));
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
            'phone'             =>  ['required', 'min:10', 'numeric'],
            'email'             =>  ['required', 'email:rfc,dns'],
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
            'phone.required' => 'ফোন নাম্বার লিখুন',
            'phone.min' => '১১ ডিজিটের ফোন নাম্বার লিখুন',
            'phone.numeric' => 'ফোন নাম্বার লিখুন',
            'email.required' => 'ইমেইল লিখুন',
            'email.email' => 'সঠিক ইমেইল লিখুন',
            'invitedate.required' => 'তারিখ লিখুন',
            'officevisitdate.required' => 'তারিখ লিখুন',
            'sidevisitdate.required' => 'তারিখ লিখুন',
            'counsiling.required' => 'এই ঘরটি পুরণ করুন',
            'targetfee.required' => 'অপশন নির্বাচন করুন',
            'targetfee.not_in' => 'অপশন নির্বাচন করুন',
            'hwant.required' => 'অপশন নির্বাচন করুন',
            'bthink.required' => 'অপশন নির্বাচন করুন',
            'mishuk.required' => 'অপশন নির্বাচন করুন',
            'planshow.required' => 'অপশন নির্বাচন করুন',
            'training.required' => 'অপশন নির্বাচন করুন',
            'comment.required' => 'মন্তব্য লিখুন',
        ]);

        $report = new Report;

        $report->userid             =   auth()->user()->id;
        $report->refereluserid      =   auth()->user()->referrer_id;
        $report->date               =   $request->date;
        $report->name               =   $request->name;
        $report->phone              =   $request->phone;
        $report->email              =   $request->email;
        $report->invitedate         =   $request->invitedate;
        $report->officevisitdate    =   $request->officevisitdate;
        $report->sidevisitdate      =   $request->sidevisitdate;
        $report->counsiling         =   $request->counsiling;
        $report->targetfee          =   $request->targetfee;
        $report->hwant              =   $request->hwant;
        $report->bthink             =   $request->bthink;
        $report->mishuk             =   $request->mishuk;
        $report->planshow           =   $request->planshow;
        $report->training           =   $request->training;
        $report->problem            =   $request->problem;
        $report->comment            =   $request->comment;

        $report->save();
        
        if ( !is_null( auth()->user()->referrer_id ) ){
        $user = User::where('id', auth()->user()->referrer_id)->get();
        Notification::send($user, new UserReportNotification($report));
        }
        else
        {
        $admin = User::where('auth_role', 3)->get();
        Notification::send($admin, new UserReportNotification($report));
        }

        $notification = array(
            'message'       => 'রিপোর্ট পাঠানো সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('report.manage')->with($notification);

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
