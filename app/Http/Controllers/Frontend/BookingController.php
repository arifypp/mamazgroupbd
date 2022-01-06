<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use lemonpatwari\bangladeshgeocode\Models\Division;
use Response;
use DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $divisions = Division::all();
        return view('Frontend.user.pages.booking.manage', compact('divisions'));
    }

    /* Dependent Table Start  */
    public function getDistrictsByDivision(Request $request){
        $data=$request->all();
        $districts=DB::table('districts')
        ->where('districts.division_id','=',$data['division'])
        ->select('id','bn_name')
        ->get();
        return Response::json($districts);
    }

    public function getThanaByDistrict(Request $request){
        $data=$request->all();
        $thana=DB::table('thanas')
        ->where('thanas.district_id','=',$data['districts'])
        ->select('id','bn_name')
        ->get();
        return Response::json($thana);
    }
    /* Dependent Table End  */

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
      
        $request->validate([
            'name'          =>      ['required', 'alpha'],
            'phonenumber'   =>      ['required', 'min:10', 'numeric'],
            'religion'      =>      ['required', 'not_in:0'],
            'nationality'   =>      ['required', 'not_in:0'],
            'nidnumber'     =>      ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'dob'           =>      ['required', 'before:today'],
            'maritalstatus' =>      ['required', 'not_in:0'],
            'fathername'    =>      ['required', 'alpha'],
            'mothername'    =>      ['required', 'alpha'],
            'spousename'    =>      ['required_if:maritalstatus,বিবাহিত'],
            'flatorhouse'   =>      ['required', 'alpha'],
            'division'      =>      ['required', 'not_in:0'],
            'ppostoffice'   =>      ['required', 'alpha'],   
            'ppostcode'     =>      ['required', 'numeric'], 
            'permanenthouse'  =>    ['required', 'alpha'],
            'permanentpostcode' =>  ['required', 'numeric'],
            'permanentaddress' =>   ['required', 'alpha'],
            'nominyname'    =>      ['required', 'alpha'],
            'nominyphone'   =>      ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'nominyaddress' =>      ['required', 'alpha'],
            'nominynid'     =>      ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'nominyrelatoin' =>     ['required', 'not_in:0'],
            'flatvalue'     =>      ['required', 'not_in:0'],
            'bookingmoney'   =>     ['required', 'numeric'],
            'bookingmoneymehtod'    =>  ['required', 'not_in:0'],
        ],
        $message = [
            'name.required' => 'আপনার নাম লিখুন',
            'name.alpha' => 'শুধুমাত্র আপনার নাম প্রযোজ্য',
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
            'fathername.alpha' => 'শুধুমাত্র আপনার পিতার নাম প্রযোজ্য',
            'mothername.required' => 'আপনার মাতার নাম লিখুন',
            'mothername.alpha' => 'শুধুমাত্র আপনার মাতার নাম প্রযোজ্য',
            'spousename.required_if' => 'আপনার স্বামি বা স্ত্রী নাম লিখুন',
            'spousename.alpha' => 'শুধুমাত্র আপনার স্বামি বা স্ত্রী নাম প্রযোজ্য',
            'flatorhouse.required'  =>  'আপনার বাড়ি অথবা ফ্ল্যাটের ঠিকানা লিখুন',
            'flatorhouse.alpha' => 'শুধুমাত্র আপনার ফ্ল্যাটের ঠিকানা নাম প্রযোজ্য',
            'division.required'  =>  'আপনার বিভাগ নির্বাচন করুন',
            'ppostoffice.alpha' => 'শুধুমাত্র আপনার পোস্ট অফিসের নাম লিখুন',
            'ppostoffice.required'  =>  'আপনার পোস্ট অফিসের নাম লিখুন',
            'ppostcode.required'         =>  'আপনার পোস্ট অফিসের কোড লিখুন',
            'ppostcode.numeric'         =>  'আপনার পোস্ট অফিসের কোড লিখুন',
            'permanenthouse.alpha' => 'শুধুমাত্র আপনার ফ্ল্যাটের ঠিকানা নাম প্রযোজ্য',
            'permanenthouse.required'  =>  'আপনার বাড়ি অথবা ফ্ল্যাটের ঠিকানা লিখুন',
            'permanentaddress.alpha' => 'শুধুমাত্র আপনার পোস্ট অফিসের নাম লিখুন',
            'permanentaddress.required'  =>  'আপনার পোস্ট অফিসের নাম লিখুন',
            'permanentpostcode.required'         =>  'আপনার পোস্ট অফিসের কোড লিখুন',
            'permanentpostcode.numeric'         =>  'আপনার পোস্ট অফিসের কোড লিখুন',
            'nominyname.required'       =>  'নমীনির নাম লিখুন',
            'nominyname.alpha'       =>  'শুধুমাত্র নমীনির নাম প্রযোজ্য',
            'nominyphone.required'     =>   'মোবাইল নাম্বার লিখুন',
            'nominyphone.min'     =>   'কমপক্ষে দশটির বেশি মোবাইল নাম্বার লিখুন',
            'nominyphone.numeric'     =>   'শুধুমাত্র মোবাইল নাম্বার প্রযোজ্য',
            'nominyaddress.required'    =>   'নমীনির ঠিকানা লিখুন',
            'nominyaddress.alpha'    =>   'শুধুমাত্র নমীনির ঠিকানা লিখুন',
            'nominynid.required'     =>   'জাতীয় পরিচয়পত্র নাম্বার লিখুন',
            'nominynid.min'     =>   'কমপক্ষে দশটির বেশি জাতীয় পরিচয়পত্র নাম্বার লিখুন',
            'nominynid.numeric'     =>   'শুধুমাত্র জাতীয় পরিচয়পত্র নাম্বার প্রযোজ্য',
            'nominyrelatoin.required'   =>  'নমীনির সম্পর্ক নির্বাচন করুন',
            'nominyrelatoin.not_in'   =>  'নমীনির সম্পর্ক নির্বাচন করুন',
            'flatvalue.required'   =>  'ফ্ল্যাট / জমির পরিমান নির্বাচন করুন',
            'flatvalue.not_in'   =>  'ফ্ল্যাট / জমির পরিমান নির্বাচন করুন',
            'bookingmoney.required'      =>  'টাকার পরিমান লিখুন',
            'bookingmoney.numeric'      =>  'অঙ্কে টাকার পরিমান লিখুন',
            'bookingmoneymehtod.required'        =>  'আপনার টাকা পাঠানোর মাধ্যম নির্বাচন করুন',
            'bookingmoneymehtod.not_in'        =>  'আপনার টাকা পাঠানোর মাধ্যম নির্বাচন করুন',
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
