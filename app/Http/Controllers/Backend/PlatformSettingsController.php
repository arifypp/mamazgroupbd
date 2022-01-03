<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Backend\PlatformSettings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Image;
use File;
use Session;

class PlatformSettingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $wsettings = PlatformSettings::orderBy('id', 'desc')->get();
        return view('Backend.settings.platform-settings', compact('wsettings'));
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
        $wsettings  =  PlatformSettings::find($id);

        $wsettings->title           = $request->wtitle;
        $wsettings->seotitle        = $request->metatitle;
        $wsettings->metadesc        = $request->description;
        $wsettings->phone           = $request->phone;
        $wsettings->address         = $request->address;
        $wsettings->city            = $request->city;
        $wsettings->postcode        = $request->postcode;
        
        $wsettings->save();

        $notification = array(
            'message'       => 'Data Updated Successfully!!!',
            'alert-type'    => 'success'
        );

        return redirect()->route('settings.manage')->with($notification);
    }

    public function updateemail(Request $request, $id)
    {
        //

        $esettings  =  PlatformSettings::find($id);

        $esettings->email           = $request->email;
        $esettings->sendername      = $request->sendername;
        $esettings->emailencryption = $request->emailencryption;
        $esettings->SMTPhost        = $request->SMTPhost;
        $esettings->SMTPport        = $request->SMTPport;
        $esettings->SMTPusername    = $request->SMTPusername;
        $esettings->SMTPpassword    = $request->SMTPpassword;
        $esettings->Emailsignature  = $request->Emailsignature;
        

 
        $esettings->save();

        $notification = array(
            'message'       => 'Data Updated Successfully!!!',
            'alert-type'    => 'success'
        ); 

        return redirect()->route('settings.manage')->with($notification);

    }

    public function updatelogo(Request $request, $id)
    {
        //
        // return $request->all();
 

        $updatelogo  =  PlatformSettings::find($id);      
        
        if( !is_null($updatelogo) )
        {
            //Admin Logo Uploading 
            $image = $request->file('websitelogowhite');
            if( !is_null($image) ){
                // Delete Existing Image
                if( File::exists('assets/images/settings/' . $updatelogo->image) ) {
                    File::delete('assets/images/settings/' . $updatelogo->image);
                }
                
                $img = rand() . '.' . $image->getClientOriginalExtension();
                $location = public_path('assets/images/settings/' . $img);

                Image::make($image)->save($location);
                $updatelogo->websitelogowhite = $img;
            }

            //Website Logo Uploading 
            $websitelogodark = $request->file('websitelogodark');
            if( !is_null($websitelogodark) ){
                // Delete Existing Image
                if( File::exists('assets/images/settings/' . $updatelogo->websitelogodark) ) {
                    File::delete('assets/images/settings/' . $updatelogo->websitelogodark);
                }
                
                $img = rand() . '.' . $websitelogodark->getClientOriginalExtension();
                $location = public_path('assets/images/settings/' . $img);

                Image::make($websitelogodark)->save($location);
                $updatelogo->websitelogodark = $img;
            }

            //Website White Favicon Uploading 
            $websitefaviconwhite = $request->file('websitefaviconwhite');
            if( !is_null($websitefaviconwhite) ){
                // Delete Existing Image
                if( File::exists('assets/images/settings/' . $updatelogo->websitefaviconwhite) ) {
                    File::delete('assets/images/settings/' . $updatelogo->websitefaviconwhite);
                }
                
                $img = rand() . '.' . $websitefaviconwhite->getClientOriginalExtension();
                $location = public_path('assets/images/settings/' . $img);

                Image::make($websitefaviconwhite)->save($location);
                $updatelogo->websitefaviconwhite = $img;
            }

            //Website Dark Favicon Uploading 
            $websitefavicondark = $request->file('websitefavicondark');
            if( !is_null($websitefavicondark) ){
                // Delete Existing Image
                if( File::exists('assets/images/settings/' . $updatelogo->websitefavicondark) ) {
                    File::delete('assets/images/settings/' . $updatelogo->websitefavicondark);
                }
                
                $img = rand() . '.' . $websitefavicondark->getClientOriginalExtension();
                $location = public_path('assets/images/settings/' . $img);

                Image::make($websitefavicondark)->save($location);
                $updatelogo->websitefavicondark = $img;
            }
            

        }

        $updatelogo->save();

        $notification = array(
            'message'       => 'Hurrah!! Data Updated Successfully!!!',
            'alert-type'    => 'success'
        ); 

        return redirect()->route('settings.manage')->with($notification);

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
