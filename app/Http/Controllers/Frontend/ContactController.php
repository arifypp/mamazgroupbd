<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\ContactPage;
use App\Models\Backend\ContactpageInfo;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Notifications\ContactMessage;
use Image;
use File;
use Session;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Frontend.pages.contact');
    }

    public function manage()
    {
        $contactinfo = ContactpageInfo::find(1);
        return view('Backend.settings.contactpage', compact('contactinfo'));

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
        $request->validate([
            'addressinfo'   =>  ['required'],
            'email'     =>  ['required'],
            'phone'     =>  ['required'],
        ],
        $message = [
            'addressinfo.required'      =>  'ঠিকানা পুরণ করা আবশ্যক!',
            'email.required'        =>  'ইমেইল পুরণ করা আবশ্যক!',
            'phone.required'        =>  'মোবাইল পুরণ করা আবশ্যক!',
        ]);

        
        $contatinfo = new ContactpageInfo;
        $contatinfo->address       =   $request->addressinfo;
        $contatinfo->email         =   $request->email;
        $contatinfo->phone         =   $request->phone;

        $contatinfo->save();

        $notification = array(
            'message'       => 'ডাটা সেভ সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return back()->with($notification);
        
    }

    /**
     * Submit contact form via frontpage
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function ctsend(Request $request)
    {
        $request->validate([
            'name'          =>  ['required'],
            'email'         =>  ['required', 'email'],
            'subject'       =>  ['required'],
            'message'       =>  ['required'],
        ],
        $message = [
            'name.required'         =>  'এই ঘরটি পুরণ করুন।',
            'email.required'        =>  'এই ঘরটি পুরণ করুন।',
            'subject.required'      =>  'এই ঘরটি পুরণ করুন।',
            'message.required'      =>  'এই ঘরটি পুরণ করুন।',
        ]
    );

    $contact = new ContactPage;
        
    $contact->name          =   $request->name;
    $contact->email         =   $request->email;
    $contact->subject       =   $request->subject;
    $contact->message       =   $request->message;

    $contact->save();

    $admin = User::where('auth_role', 3)->get();
    Notification::send($admin, new ContactMessage($contact));

    return response()->json(['success' =>true, 'message'=> 'আপনার ম্যাসেজ পাঠানো হয়েছে!!!']);

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
        $contatinfo = ContactpageInfo::find($id);
        $contatinfo->address       =   $request->addressinfo;
        $contatinfo->email         =   $request->email;
        $contatinfo->phone         =   $request->phone;

        $contatinfo->save();

        $notification = array(
            'message'       => 'ডাটা সেভ সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return back()->with($notification);
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
        $delete = ContactPage::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "ডিলেট সম্পন্ন হয়েছে!!!";
            
        } else {
            $success = false;
            $message = "ডিলেটে ত্রুটি রয়েছে!!!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
