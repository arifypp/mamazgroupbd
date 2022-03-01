<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Frontend\About;
use App\Models\Frontend\AboutContent;
use Illuminate\Support\Str;
use Image;
use File;
use Session;

class AboutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('Frontend.pages.about');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $about = About::find(1);
        return view('Backend.settings.aboutpage', compact('about'));
    }
    
    // Store page title and description
    public function storepagetitle(Request $request)
    {
        $request->validate([
            'title'     =>  ['required'],
            'desc'      =>  ['required', 'min:10'],
        ],
        $message = [
            'title.required'    =>  'ঘরটি পূরণ করা আবশ্যক।',
            'desc.required'     =>  'ঘরটি পূরণ করা আবশ্যক।',
            'desc.min'          =>  'কমপক্ষে ১০টি শব্দের বেশি লিখুন।',
        ]);

        $pagetitle = new About;
        $pagetitle->title   = $request->title;
        $pagetitle->desc    = $request->desc;

        $pagetitle->save();
        $notification = array(
            'message'       => 'ডাটা সেভ সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return back()->with($notification);

    }
    

    public function updatepagetitle(Request $request, $id)
    {
        $updateabout = About::find($id);

        if( !is_null ($updateabout) )
        {
            $updateabout->title   = $request->title;
            $updateabout->desc    = $request->desc;

            $updateabout->save();
            $notification = array(
                'message'       => 'ডাটা সেভ সম্পন্ন হয়েছে!!!',
                'alert-type'    => 'success'
            );

            return back()->with($notification);
        }
        else{
            $notification = array(
                'message'       => 'লিংকের মধ্যে ত্রুটি রুয়েছে।!!!',
                'alert-type'    => 'error'
            );
    
            return back()->with($notification);
        }
    }

    public function store(Request $request)
    {
        //
        $request->validate([
            'name'              =>  ['required'],
            'description'       =>  ['required'],
            'layout'            =>  ['required', 'not_in:0'],
            'image'             =>  ['nullable', 'mimes:jpeg,png,jpg,gif,svg|max:2048']
        ],
        $message = [
            'name.required' =>  'এই ঘরটি পূরণ করুন!',
            'description.required'  =>  'এই ঘরটি পূরণ করুন!',
            'layout.required'   =>  'এই ঘরটি পূরণ করুন!',
            'layout.not_in'   =>  'এই ঘরটি পূরণ করুন!',
            'image.null'    =>  'ছবি নির্বাচন করুন!' ,
            'image.mimes'    =>  'সঠিক ফরম্যাটে ছবি আপলোড করুন করুন!' ,
        ]);

        $aboutcontent = new AboutContent;
        $aboutcontent->title        =   $request->name;
        $aboutcontent->desc         =   $request->description;
        $aboutcontent->layout       =   $request->layout;

        if(!is_null($request->image)){
            $aboutimg = $request->file('image');
            if( !is_null($aboutimg) ){
                // Delete Existing Image
                if( File::exists('assets/images/aboutpage' . $aboutcontent->image) ) {
                    File::delete('assets/images/aboutpage' . $aboutcontent->image);
                }
                
                $img = rand() . '.' . $aboutimg->getClientOriginalExtension();
                $location = public_path('assets/images/aboutpage' . $img);

                Image::make($aboutimg)->save($location);
                $aboutcontent->image = $img;
            }
        }

        $aboutcontent->save();

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
