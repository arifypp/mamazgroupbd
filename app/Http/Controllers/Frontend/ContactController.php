<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\ContactPage;

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
            'name.required'         =>  'This field is required',
            'email.required'        =>  'This field is required',
            'subject.required'      =>  'This field is required',
            'message.required'      =>  'This field is required',
        ]
    );

    $contact = new ContactPage;
        
    $contact->name          =   $request->name;
    $contact->email         =   $request->email;
    $contact->subject       =   $request->subject;
    $contact->message       =   $request->message;

    $contact->save();
    return response()->json(['success' =>true, 'message'=> 'আপনার ডাটা পাঠানো হয়েছে!!!']);

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
