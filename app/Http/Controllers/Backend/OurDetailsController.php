<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\OurDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Image;
use File;
use Session;
class OurDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $ourdetails = OurDetails::find(1);
        return view('Backend.settings.oursetting', compact('ourdetails'));
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
        
        
        $ourdetails = new OurDetails;

        $ourdetails->title  =   $request->title;
        $ourdetails->desc   =   $request->desc;

        if(!is_null($request->image)){
            $oursettingimg = $request->file('image');
            if( !is_null($oursettingimg) ){
                // Delete Existing Image
                if( File::exists('assets/images/' . $ourdetails->image) ) {
                    File::delete('assets/images/' . $ourdetails->image);
                }
                
                $img = rand() . '.' . $oursettingimg->getClientOriginalExtension();
                $location = public_path('assets/images/' . $img);

                Image::make($oursettingimg)->save($location);
                $ourdetails->image = $img;
            }
        }
        $ourdetails->save();

        $notification = array(
            'message'       => 'ডাটা সেভ সম্পন্ন হয়েছে!!!',
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
        $ourdetails = OurDetails::find($id);

        $ourdetails->title  =   $request->title;
        $ourdetails->desc   =   $request->desc;

        if( !is_null($request->image) )
        {
            // Delete Existing Image
            if( File::exists('assets/images//' . $ourdetails->image) ) {
                File::delete('assets/images//' . $ourdetails->image);
            }

            $image = $request->file('image');
            $img = rand() . '.' . $image->getClientOriginalExtension();
            $location = public_path('assets/images/' . $img);

            Image::make($image)->save($location);
            $ourdetails->image = $img;

        }

        $ourdetails->save();

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
    }
}
