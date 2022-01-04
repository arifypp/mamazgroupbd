<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\HompageHero;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Image;
use File;
use Session;

class HomepageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $herosetting =  HompageHero::find(1);
        return view('Backend.settings.herosettings', compact('herosetting'));
    }

    public function favclient()
    {
        return view('Backend.settings.favclientsetting');
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
        $request->validate([
            'title' => ['required', 'min:5'],
            'desc' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ],
        $message = [
            'title.required' => 'এই ঘরটি পূরণ করুন',
            'desc.required' => 'এই ঘরটি পূরণ করুন',
            'image.required' => 'এই ঘরটি পূরণ করুন',

         ]);

        $herosetting = HompageHero::find($id);
        $herosetting->title       = $request->title;
        $herosetting->description = $request->desc;

        if(!is_null($request->image)){
            $websitefavicondark = $request->file('image');
            if( !is_null($websitefavicondark) ){
                // Delete Existing Image
                if( File::exists('assets/images/settings/' . $herosetting->image) ) {
                    File::delete('assets/images/settings/' . $herosetting->image);
                }
                
                $img = rand() . '.' . $websitefavicondark->getClientOriginalExtension();
                $location = public_path('assets/images/settings/' . $img);

                Image::make($websitefavicondark)->save($location);
                $herosetting->image = $img;
            }
        }

        $herosetting->save();

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
