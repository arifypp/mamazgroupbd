<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use lemonpatwari\bangladeshgeocode\Models\Division;
use App\Models\Frontend\Booking;
use App\Models\User;
use CoreProc\WalletPlus\Models\WalletType;
use App\Notifications\BookingNotification;
use Illuminate\Support\Facades\Notification;
use Illuminate\Http\Request;
use Illuminate\Validation\Validator;
use Response;
use DB;
use Session;
use Auth;
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

    public function list()
    {
        $bookings = Booking::where('user_id', auth()->user()->id)->get();
        return view('Frontend.user.pages.booking.list', compact('bookings')); 
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

    // Pdf file generating
    public function generatepdf($id)
    {
        $bookings = Booking::find($id);

        if (!is_null($bookings) && auth()->user()) 
        {
            //this command for generate pdf
            $mpdf = new \Mpdf\Mpdf([
                'default_font_size' =>  14,
                'format'            => 'A4',
                'default_font'      => 'notosansbengali',
                'orientation'       => 'P',
                'title'             => 'mamazpdf',
                'showImageErrors'   => true,
            ]);


            $mpdf->SetTitle($bookings->bookingid. '.pdf');

            $stylesheet = file_get_contents('style.css');


            $myoutput = view('Frontend.user.pages.booking.pdf', compact('bookings'));

            
            // Write some html code
            $mpdf->WriteHTML($stylesheet,1);
            $mpdf->WriteHTML($myoutput,2);

            // Output a pdf directory to the browser
            $mpdf->Output();
        }
    }

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
            'name'          =>      ['required'],
            'phonenumber'   =>      ['required', 'min:10', 'numeric'],
            'religion'      =>      ['required', 'not_in:0'],
            'nationality'   =>      ['required', 'not_in:0'],
            'nidnumber'     =>      ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'dob'           =>      ['required', 'before:today'],
            'maritalstatus' =>      ['required', 'not_in:0'],
            'fathername'    =>      ['required'],
            'mothername'    =>      ['required'],
            'spousename'    =>      ['required_if:maritalstatus,বিবাহিত'],
            'flatorhouse'   =>      ['required'],
            'division'      =>      ['required', 'not_in:0'],
            'ppostoffice'   =>      ['required'],   
            'ppostcode'     =>      ['required', 'numeric'], 
            'permanenthouse'  =>    ['required'],
            'permanentpostcode' =>  ['required', 'numeric'],
            'permanentpostoffice' =>   ['required'],
            'nominyname'    =>      ['required'],
            'nominyphone'   =>      ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'nominyaddress' =>      ['required'],
            'nominynid'     =>      ['required','min:8', 'numeric', 'regex:/(?:\d{17}|\d{13}|\d{10})/'],
            'nominyrelatoin' =>     ['required', 'not_in:0'],
            'flatvalue'     =>      ['required', 'not_in:0'],
            
        ],
        $message = [
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
            'spousename.required_if' => 'আপনার স্বামি বা স্ত্রী নাম লিখুন',
            'flatorhouse.required'  =>  'আপনার বাড়ি অথবা ফ্ল্যাটের ঠিকানা লিখুন',
            'division.required'  =>  'আপনার বিভাগ নির্বাচন করুন',
            'ppostoffice.required'  =>  'আপনার পোস্ট অফিসের নাম লিখুন',
            'ppostcode.required'         =>  'আপনার পোস্ট অফিসের কোড লিখুন',
            'ppostcode.numeric'         =>  'আপনার পোস্ট অফিসের কোড লিখুন',
            'permanenthouse.required'  =>  'আপনার বাড়ি অথবা ফ্ল্যাটের ঠিকানা লিখুন',
            'permanentpostoffice.required'  =>  'আপনার পোস্ট অফিসের নাম লিখুন',
            'permanentpostcode.required'         =>  'আপনার পোস্ট অফিসের কোড লিখুন',
            'permanentpostcode.numeric'         =>  'আপনার পোস্ট অফিসের কোড লিখুন',
            'nominyname.required'       =>  'নমীনির নাম লিখুন',
            'nominyphone.required'     =>   'মোবাইল নাম্বার লিখুন',
            'nominyphone.min'     =>   'কমপক্ষে দশটির বেশি মোবাইল নাম্বার লিখুন',
            'nominyphone.numeric'     =>   'শুধুমাত্র মোবাইল নাম্বার প্রযোজ্য',
            'nominyaddress.required'    =>   'নমীনির ঠিকানা লিখুন',
            'nominynid.required'     =>   'জাতীয় পরিচয়পত্র নাম্বার লিখুন',
            'nominynid.min'     =>   'কমপক্ষে দশটির বেশি জাতীয় পরিচয়পত্র নাম্বার লিখুন',
            'nominynid.numeric'     =>   'শুধুমাত্র জাতীয় পরিচয়পত্র নাম্বার প্রযোজ্য',
            'nominyrelatoin.required'   =>  'নমীনির সম্পর্ক নির্বাচন করুন',
            'nominyrelatoin.not_in'   =>  'নমীনির সম্পর্ক নির্বাচন করুন',
            'flatvalue.required'   =>  'ফ্ল্যাট / জমির পরিমান নির্বাচন করুন',
            'flatvalue.not_in'   =>  'ফ্ল্যাট / জমির পরিমান নির্বাচন করুন',
            
         ]);

        $booking = new Booking;

        $booking->bookingid         =   rand(0, 9999999);
        $booking->user_id           =   auth()->user()->id;
        $booking->name              =   $request->name;
        $booking->phonenumber       =   $request->phonenumber;
        $booking->religion          =   $request->religion;
        $booking->nationality       =   $request->nationality;
        $booking->nidnumber         =   $request->nidnumber;
        $booking->dob               =   $request->dob;
        $booking->maritalstatus     =   $request->maritalstatus;
        $booking->fathername        =   $request->fathername;
        $booking->fatherphone       =   $request->fatherphone;
        $booking->mothername        =   $request->mothername;
        $booking->motherphone       =   $request->motherphone;
        $booking->spousename        =   $request->spousename;
        $booking->spousephonenumber =   $request->spousephonenumber;
        $booking->flatorhouse       =   $request->flatorhouse;
        $booking->divisionid        =   $request->division;
        $booking->districtid        =   $request->district;
        $booking->thanaid           =   $request->thana;
        $booking->ppostoffice       =   $request->ppostoffice;
        $booking->ppostcode         =   $request->ppostcode;
        $booking->permanenthouse    =   $request->permanenthouse;
        $booking->permanetdivisionid =   $request->permanetdivision;
        $booking->permanentdistrictid =   $request->permanentdistrict;
        $booking->permanentthanaid  =   $request->permanentthana;
        $booking->permanentpostoffice =   $request->permanentpostoffice;
        $booking->permanentpostcode =   $request->permanentpostcode;
        $booking->nominyname        =   $request->nominyname;
        $booking->nominyphone       =   $request->nominyphone;
        $booking->nominyaddress     =   $request->nominyaddress;
        $booking->nominynid         =   $request->nominynid;
        $booking->nominyrelatoin    =   $request->nominyrelatoin;
        $booking->referelname       =   $request->referelname;
        $booking->referelphone      =   $request->referelphone;
        $booking->referelemail      =   $request->referelemail;
        $booking->landvalue         =   $request->flatvalue;
        $booking->landquality       =   $request->landquality ;
        $booking->paymentSystem     =   $request->inlineRadioOptions ;
        $booking->kistiDuration     =   $request->kistyoption ;
        $booking->bookingcash       =   '165000' ;
        $booking->total_flat_price  =   $request->total_flat_price;
        $booking->kistypayment      =   $request->kistypayment;
        $booking->fullamount        =   $request->total_flat_price;

        $user = User::where('id', Auth::user()->id)->first();

        $userAmount = WalletType::find(14);

        $Withdrawrequestwallettaka = $user->wallet($userAmount->id);


        if( $Withdrawrequestwallettaka->balance <=  0)
        {
            return response()->json(['success' =>true, 'message'=> 'আপনার পর্যাপ্ত মামাজ পয়সা নেই।!!!']);
        }

        $booking->dueamount  =   '165000' - $Withdrawrequestwallettaka->balance * config('bonus_settings.mamazpoisha');

        $adminpayment = User::where('auth_role', 3)->first();

        $AdminAmnt = WalletType::find(32);
        $bookingPay = $Withdrawrequestwallettaka->balance * config('bonus_settings.mamazpoisha');
        $adminpendingwallet = $adminpayment->wallet($AdminAmnt->id);

        if( empty( $adminpayment->wallets()->wallet_type_id )  )
        {
            $adminpayment->wallets()->create(['wallet_type_id' => $AdminAmnt->id]);
            // Add payment
            $AdminAmountIncrements = $adminpayment->wallet('Pending');
            $AdminAmountIncrements->incrementBalance($bookingPay);
            $AdminAmountIncrements->balance;

            $UserAmountDecrements = $user->wallet('Mamaz Money');
            $UserAmountDecrements->decrementBalance($Withdrawrequestwallettaka->balance);
            $UserAmountDecrements->balance;
        }
        else
        {
            $AdminAmountIncrements = $adminpayment->wallet('Pending');
            $AdminAmountIncrements->incrementBalance($bookingPay);
            $AdminAmountIncrements->balance;

            $UserAmountDecrements = $user->wallet('Mamaz Money');
            $UserAmountDecrements->decrementBalance($Withdrawrequestwallettaka->balance);
            $UserAmountDecrements->balance;
        }

        

        
        $booking->save();

        $user = User::where('id', $user->referrer_id)->get();
        Notification::send($user, new BookingNotification($booking));

        $bookinguser = User::where('id', $user->id)->get();
        Notification::send($bookinguser, new BookingNotification($booking));

        $admin = User::where('auth_role', 3)->get();
        Notification::send($admin, new BookingNotification($booking));

        return response()->json(['success' =>true, 'message'=> 'আপনার বুকিং সম্পন্ন হয়েছে!!!']);
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
    public function duecash(Request $request, $id)
    {
        //
        $request->validate([
            'amount'                    =>  ['required', 'integer'],
        ]); 
        
        if( $request->inlineRadioOptions  == 'Directly' )
        {
            $bookigndueamount = Booking::find($id);

            $bookigndueamount->dueamount     =   $request->input('amount');            
            
            $bookigndueamount->decrement('dueamount', $bookigndueamount->dueamount);

            $adminpayment = User::where('auth_role', 3)->first();

            $AdminAmnt = WalletType::find(7);

            $adminpendingwallet = $adminpayment->wallet($AdminAmnt->id);

            if( empty( $adminpayment->wallets()->wallet_type_id )  )
            {
                $adminpayment->wallets()->create(['wallet_type_id' => $AdminAmnt->id]);
                // Add payment
                $AdminAmountIncrements = $adminpayment->wallet('Assets Money');
                $AdminAmountIncrements->incrementBalance($request->amount);
                $AdminAmountIncrements->balance;
            }
            
            $bookigndueamount->save();

            $notification = array(
                'message'       => 'পেমেন্ট সম্পন্ন হয়েছে!!!',
                'alert-type'    => 'success'
            );

            return back()->with($notification);

        }
        else if( $request->inlineRadioOptions  == 'Cashbonus' )
        {
            $bookigndueamount = Booking::find($id);

            $bookigndueamount->dueamount     =   $request->input('amount');

            $user = User::where('id', Auth::user()->id)->first();


            $Withdrawrequestwallettaka = $user->wallet('Cash Money');


            if( $Withdrawrequestwallettaka->balance <=  0)
            {
                $notification = array(
                    'message'       => 'আপনার পর্যাপ্ত ক্যাশ টাকা নেই।!!!',
                    'alert-type'    => 'error'
                );
    
                return back()->with($notification);

            }

            $adminpayment = User::where('auth_role', 3)->first();

            $AdminAmnt = WalletType::find(7);

            $adminpendingwallet = $adminpayment->wallet($AdminAmnt->id);

            if( empty( $adminpayment->wallets()->wallet_type_id )  )
            {
                $adminpayment->wallets()->create(['wallet_type_id' => $AdminAmnt->id]);
                // Add payment
                $AdminAmountIncrements = $adminpayment->wallet('Assets Money');
                $AdminAmountIncrements->incrementBalance($request->amount);
                $AdminAmountIncrements->balance;
            }
            else
            {
                $AdminAmountIncrements = $adminpayment->wallet('Assets Money');
                $AdminAmountIncrements->incrementBalance($request->amount);
                $AdminAmountIncrements->balance;

                
                $UserAmountDecrements = $adminpayment->wallet('Assets Money');
                $UserAmountDecrements->decrementBalance($request->amount);
                $UserAmountDecrements->balance;
            }

            $bookigndueamount->save();           


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
    }
}