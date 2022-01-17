<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Backend\Landcat;
use App\Models\Backend\LandValue;
use Session;

class LandcatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $landcat  = Landcat::orderBy('id', 'desc')->get();
        return view('Backend.landcat.manage', compact('landcat'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Backend.landcat.create');
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
            'landvalue'         =>  ['required'],
            'landprice'         =>  ['required'],
            'status'            =>  ['required', 'not_in:0'],
            'comment'           =>  ['required'],
        ],
        $message = [
            'landvalue.required' => 'জমির পরিমাণ লিখুন',
            'landprice.required' => 'জমির মুল্য লিখুন',
            'status.required' => 'জমির স্টাটার্স নির্বাচন করুন',
            'status.not_in' => 'জমির সাস্টার্স নির্বাচন করুন',
            'comment.required' => 'জমির পরিমাণ লিখুন',           
        ]);

        $landcat  = new Landcat;

        $landcat->landvalue     =   $request->landvalue;
        $landcat->landprice     =   $request->landprice;
        $landcat->status        =   $request->status;
        $landcat->comment       =   $request->comment;

        $landcat->save();

        $Rlandvalue = LandValue::find('1');
        $newlandvalue = $Rlandvalue->totalland + $landcat->landvalue;
        $remaindland = $Rlandvalue->remainland + $landcat->landvalue;
        $Rlandvalue->totalland = $newlandvalue;
        $Rlandvalue->remainland = $remaindland;
        $Rlandvalue->save();
        

        $notification = array(
            'message'       => 'জমি তৈরি করা সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('landcat.manage')->with($notification);

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
        $landcat  =  Landcat::find($id);
        if( !is_null($landcat) ){
            return view('Backend.landcat.edit', compact('landcat'));
        }
        else{
            $notification = array(
                'message'       => 'জমি আইডি খুজে পাওয়া যায়নি!!!',
                'alert-type'    => 'warning'
            );
    
            return back()->with($notification);
        }
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
        $landcat  =  Landcat::find($id);

        $landcat->landvalue     =   $request->landvalue;
        $landcat->landprice     =   $request->landprice;
        $landcat->status        =   $request->status;
        $landcat->comment       =   $request->comment;

        $landcat->save();

        $Rlandvalue = LandValue::find('1');
        $newlandvalue = $Rlandvalue->totalland + $landcat->landvalue;
        $remaindland = $Rlandvalue->remainland + $landcat->landvalue;
        $Rlandvalue->totalland = $newlandvalue;
        $Rlandvalue->remainland = $remaindland;
        $Rlandvalue->save();

        $notification = array(
            'message'       => 'জমি আপডেট করা সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('landcat.manage')->with($notification);
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
        $landcat = Landcat::find($id);
        $Rlandvalue = LandValue::find('1');
        $remaindland = $Rlandvalue->remainland - $landcat->landvalue;
        $Rlandvalue->remainland = $remaindland;
        $Rlandvalue->save();

        $delete = Landcat::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "ডিলেট সম্পন্ন হয়েছে!!!";
            
        } else {
            $success = true;
            $message = "ডিলেটে ত্রুটি রয়েছে!!!";
        }

        //  Return response
        return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    }
}
