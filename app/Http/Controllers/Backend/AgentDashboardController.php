<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use Illuminate\Notifications\DatabaseNotification;
use App\Models\User;
use App\Models\Frontend\WalletsLadger;
use Auth;
use Session;

class AgentDashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $year = date('Y');

        $current = '';
        $previous = '';
        
        for ($i = 0; $i < 12; $i++) {
            $start_date = date("Y-m-d", strtotime( date( 'Y-01-01' )." $i months"));
            $end_date   = date("Y-m-t", strtotime($start_date));

            $currentData =  WalletsLadger::getCountVisitor($start_date, $end_date);
            $current .= $currentData.',';

            $previous_start_date = date("Y-m-d", strtotime("-1 year", strtotime($start_date)));
            $previous_end_date = date("Y-m-t", strtotime($previous_start_date));


            $previousData =  WalletsLadger::getCountVisitor($previous_start_date, $previous_end_date);
            $previous .= $previousData.',';

        }

        $data['current'] = rtrim($current,',');
        $data['previous'] = rtrim($previous,',');

        return view('Backend.Agent.dashboard', $data);
        
    }

    public function notify(Request $request, $id)
    {
        $notification = auth()->user()->notifications()->find($id);

        if($notification) {
            $notification->markAsRead();
        }
        return response()->json(['success' =>true, 'message'=> 'mark as read!!!']);
    }

    // User level updating
    public function updatepromoid(Request $request, $id)
    {
        $promotelevel = User::find($id);
        if( $promotelevel->auth_promote == Auth::user()->auth_promote )
        {
            $promotelevel->auth_promote += 1;
        }
        $promotelevel->save();
        return response()->json(['success' =>true, 'message'=> 'Level is up now!!!']);

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
