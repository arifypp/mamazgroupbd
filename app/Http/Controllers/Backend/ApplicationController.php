<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Frontend\Application;
use App\Notifications\ApplicationNotification;
use App\Notifications\ApplicationApproved;
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
        $application = Application::orderBy('id', 'desc')->get();
        return view('Backend.application.manage', compact('application'));
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
    public function pending()
    {
        //
        $application = Application::orderBy('id', 'desc')->get();
        return view('Backend.application.manage', compact('application'));
    }

    public function show($id)
    {
        $application = Application::find($id);

        if( !is_null($application) ){
            return view('Backend.application.show', compact('application'));
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
        $application = Application::find($id);


        if( !is_null($application) ){
            if($application->status == 0){
                $application->status    =   1;
                $application->save();
                
                $user = User::where('id', $application->referrelID)->get();
                Notification::send($user, new ApplicationApproved($application));

                $applicantID = User::where('id', $application->auth_id)->get();
                Notification::send($applicantID, new ApplicationApproved($application));

                return response()->json(['success' =>true, 'message'=> 'আবেদন এপ্রুভ করা হয়েছে!!!']);
            }
            else{
                return response()->json(['success' =>true, 'message'=> 'আবেদন পূর্বেই এপ্রুভ করা হয়েছে!!!']);
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
    }
}
