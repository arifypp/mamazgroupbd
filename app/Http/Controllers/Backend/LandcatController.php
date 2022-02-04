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
            'mainland'          =>  ['required'],
            'utility'           =>  ['required'],
            'usedland'          =>  ['required'],
            'plotnumber'        =>  ['required'],
            'floornumber'       =>  ['required'],
            'unitnumber'        =>  ['required'],
            'totalsquarefit'    =>  ['required'],
            'status'            =>  ['required', 'not_in:0'],
            'csnumber'          =>  ['required'],
            'sanumber'          =>  ['required'],
            'rsnumber'          =>  ['required'],
            'bsnumber'          =>  ['required'],
            'jlnumber'          =>  ['required'],
            'dcrnumber'         =>  ['required'],
            'kharicaseno'       =>  ['required'],
            'khajnayear'        =>  ['required'],
            'maindolilnumber'   =>  ['required'],
            'vayanumber'        =>  ['required'],
            'lanbdescription'   =>  ['required'],
        ],
        $message = [
            'mainland.required'         =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'utility.required'          =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'usedland.required'         =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'plotnumber.required'       =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'floornumber.required'      =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'unitnumber.required'       =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'totalsquarefit.required'   =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'csnumber.required'         =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'status.required'           =>  'স্টাটার্স নির্বাচন করুন।',
            'status.not_in'             =>  'স্টাটার্স নির্বাচন করুন।',
            'csnumber.required'         =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'sanumber.required'         =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'rsnumber.required'         =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'bsnumber.required'         =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'jlnumber.required'         =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'dcrnumber.required'        =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'kharicaseno.required'      =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'khajnayear.required'       =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'maindolilnumber.required'  =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'vayanumber.required'       =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',
            'lanbdescription.required'  =>  'এই ঘরটি অবশ্যই পূরণ করতে হবে।',        
        ]);

        $landcat  = new Landcat;
        $landcat->mainland          =   $request->mainland;
        $landcat->utility           =   $request->utility;
        $landcat->usedland          =   $request->usedland;
        $landcat->plotnumber        =   $request->plotnumber;
        $landcat->floornumber       =   $request->floornumber;
        $landcat->unitnumber        =   $request->unitnumber;
        $landcat->totalsquarefit    =   $request->totalsquarefit;
        $landcat->status            =   $request->status;
        $landcat->csnumber          =   $request->csnumber;
        $landcat->sanumber          =   $request->sanumber;
        $landcat->rsnumber          =   $request->rsnumber;
        $landcat->bsnumber          =   $request->bsnumber;
        $landcat->jlnumber          =   $request->jlnumber;
        $landcat->dcrnumber         =   $request->dcrnumber;
        $landcat->kharicaseno       =   $request->kharicaseno;
        $landcat->khajnayear        =   $request->khajnayear;
        $landcat->maindolilnumber   =   $request->maindolilnumber;
        $landcat->vayanumber        =   $request->vayanumber;
        $landcat->lanbdescription   =   $request->lanbdescription;
        
        $landcat->save();

        $Rlandvalue = LandValue::find('1');
        $newlandvalue = $Rlandvalue->totalland + $landcat->totalsquarefit;
        $remaindland = $Rlandvalue->remainland + $landcat->totalsquarefit;
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

        $landcat->mainland          =   $request->mainland;
        $landcat->utility           =   $request->utility;
        $landcat->usedland          =   $request->usedland;
        $landcat->plotnumber        =   $request->plotnumber;
        $landcat->floornumber       =   $request->floornumber;
        $landcat->unitnumber        =   $request->unitnumber;
        $landcat->totalsquarefit    =   $request->totalsquarefit;
        $landcat->status            =   $request->status;
        $landcat->csnumber          =   $request->csnumber;
        $landcat->sanumber          =   $request->sanumber;
        $landcat->rsnumber          =   $request->rsnumber;
        $landcat->bsnumber          =   $request->bsnumber;
        $landcat->jlnumber          =   $request->jlnumber;
        $landcat->dcrnumber         =   $request->dcrnumber;
        $landcat->kharicaseno       =   $request->kharicaseno;
        $landcat->khajnayear        =   $request->khajnayear;
        $landcat->maindolilnumber   =   $request->maindolilnumber;
        $landcat->vayanumber        =   $request->vayanumber;
        $landcat->lanbdescription   =   $request->lanbdescription;
        
        $landcat->save();

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
