<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Frontend\Application;
use App\Notifications\ApplicationNotification;
use Auth;
use Response;
use DB;
use Session;
class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Frontend.user.pages.apply.create');

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
            'name'          =>      ['required'],
            'phonenumber'   =>      ['required', 'min:10', 'numeric'],
            'religion'      =>      ['required', 'not_in:0'],
            'nationality'   =>      ['required', 'not_in:0'],
            'nidnumber'     =>      ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'dob'           =>      ['required', 'before:today'],
            'maritalstatus' =>      ['required', 'not_in:0'],
            'fathername'    =>      ['required'],
            'mothername'    =>      ['required'],
            'permanentaddress'  =>  ['required'],
            'presentaddress'  =>  ['required'],
            'bthink'        =>  ['required', 'not_in:-0'],
           ], $message = [
            'name.required' => 'আপনার নাম লিখুন',
            'phonenumber.required' => 'আপনার ফোন নাম্বার লিখুন',
            'phonenumber.min' => 'আপনার মোবাইল নাম্বারের সংখ্যায় ত্রুটি রয়েছে',
            'phonenumber.numeric' => 'আপনার মোবাইল নাম্বারের সংখ্যায় ত্রুটি রয়েছে',
            'religion.required' => 'আপনার ধর্ম নির্বাচন করুন',
            'religion.not_in' => 'আপনার ধর্ম নির্বাচন করুন',
            'nationality.required' => 'আপনার জাতীয়তা নির্বাচন করুন',
            'nationality.not_in' => 'আপনার জাতীয়তা নির্বাচন করুন',
            'nidnumber.required' => 'আপনার জাতীয় পরিচয় নাম্বার লিখুন',
            'nidnumber.min' => 'আপনার জাতীয় পরিচয় নাম্বারের সংখ্যায় ত্রুটি রয়েছে',
            'nidnumber.numeric' => 'আপনার জাতীয় পরিচয় নাম্বারের সংখ্যায় ত্রুটি রয়েছে',
            'nidnumber.regex' => 'আপনার জাতীয় পরিচয় নাম্বারের সংখ্যায় ত্রুটি রয়েছে',
            'dob.required' => 'আপনার জন্ম তারিখ পছন্দ করুন',
            'dob.before' => 'আপনার জন্ম তারিখ সঠিক করুন',
            'maritalstatus.required' => 'আপনার বৈবাহিক অবস্থা নির্বাচন করুন',
            'maritalstatus.not_in' => 'আপনার বৈবাহিক অবস্থা নির্বাচন করুন',
            'fathername.required' => 'আপনার পিতার নাম লিখুন',
            'mothername.required' => 'আপনার মাতার নাম লিখুন',
            'presentaddress.required' => 'আপনার বর্তমান ঠিকানা লিখুন',
            'permanentaddress.required' => 'আপনার স্থায়ী ঠিকানা লিখুন',
            'bthink.required' => 'শিক্ষাগত যোগ্যতা পছন্দ করুন',
        ]);

        $application = new Application;

        $application->name                  =   $request->name;
        $application->auth_id               =   Auth::user()->id;
        $application->referrelID            =   Auth::user()->referrer_id;
        $application->phonenumber           =   $request->phonenumber;
        $application->religion              =   $request->religion;
        $application->nationality           =   $request->nationality;
        $application->nidnumber             =   $request->nidnumber;
        $application->dob                   =   $request->dob;
        $application->maritalstatus         =   $request->maritalstatus;
        $application->fathername            =   $request->fathername;
        $application->mothername            =   $request->mothername;
        $application->permanentaddress      =   $request->permanentaddress;
        $application->presentaddress        =   $request->presentaddress;
        $application->education             =   $request->bthink;

        $application->save();

        $user = User::where('id', $application->referrelID)->get();
        Notification::send($user, new ApplicationNotification($application));

        // $bookinguser = User::where('id', $application->auth_id)->get();
        // Notification::send($bookinguser, new ApplicationNotification($application));


        $notification = array(
            'message'       => 'আপনার আবেদন সম্পন্ন হয়েছে। অপেক্ষা করুন এডমিন যোগাযোগ করবেন!!!',
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
    }
}
