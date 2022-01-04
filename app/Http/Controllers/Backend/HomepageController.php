<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\HompageHero;
use App\Models\Backend\FavClient;
use App\Models\Backend\FavclientLogo;
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
        $favclient = FavClient::find(1);
        return view('Backend.settings.favclientsetting', compact('favclient'));
    }

    public function favclientupdate(Request $request, $id)
    {
        $request->validate([
            'title' => ['required', 'min:5'],
            'desc' => ['required'],
        ],
        $message = [
            'title.required' => 'এই ঘরটি পূরণ করুন',
            'desc.required' => 'এই ঘরটি পূরণ করুন',
        ]);

        $favclient = FavClient::find($id);

        $favclient->title       =   $request->title;
        $favclient->desc        =   $request->desc;

        $favclient->save();

        $notification = array(
            'message'       => 'ডাটা সেভ সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return back()->with($notification);

    }

    public function favclientlogo(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:5'],
            'url' => ['required'],
            'image' => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ],
        $message = [
            'name.required' => 'এই ঘরটি পূরণ করুন',
            'url.required' => 'এই ঘরটি পূরণ করুন',
            'image.required' => 'এই ঘরটি পূরণ করুন',

         ]);

         $favlogo = new FavclientLogo;

         $favlogo->name     =   $request->name;
         $favlogo->url      =   $request->url;

         if(!is_null($request->image)){
            $websitefavicondark = $request->file('image');
            if( !is_null($websitefavicondark) ){
                // Delete Existing Image
                if( File::exists('assets/images/clients/' . $favlogo->image) ) {
                    File::delete('assets/images/clients/' . $favlogo->image);
                }
                
                $img = rand() . '.' . $websitefavicondark->getClientOriginalExtension();
                $location = public_path('assets/images/clients/' . $img);

                Image::make($websitefavicondark)->save($location);
                $favlogo->image = $img;
            }
        }

        $favlogo->save();

        $notification = array(
            'message'       => 'ডাটা সেভ সম্পন্ন হয়েছে!!!',
            'alert-type'    => 'success'
        );

        return back()->with($notification);

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
