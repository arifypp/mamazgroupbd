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
