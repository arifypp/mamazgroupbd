<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Frontend\{Ourservice, Ourserviceshead};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use Image;
use File;
use Session;

class ServiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $service = Ourservice::all();
        $servicehead = Ourserviceshead::find(1);
        return view('Backend.settings.service', compact('service', 'servicehead'));
    }

    /**
     * Service heading update.
     *
     * @return \Illuminate\Http\Response
     */
    public function storehead(Request $request, $id)
    {
        //
        $servicetitle = Ourserviceshead::find($id);

        if( !is_null($servicetitle) ){
            
            $request->validate([
                'title' => ['required', 'min:5'],
                'desc' => ['required'],
            ],
            $message = [
                'title.required' => 'এই ঘরটি পূরণ করুন',
                'desc.required' => 'এই ঘরটি পূরণ করুন',
            ]);

            $servicetitle->title       =   $request->title;
            $servicetitle->desc        =   $request->desc;

            $servicetitle->save();

            $notification = array(
                'message'       => 'ডাটা সেভ সম্পন্ন হয়েছে!!!',
                'alert-type'    => 'success'
            );

            return back()->with($notification);
        }
        else{
            dd("Data not found create new page");
            
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeservice(Request $request)
    {
        //
        $request->validate([
            'name'                  =>  ['required'],
            'status'                =>  ['required', 'not_in:3'],
            'featured'              =>  ['required', 'not_in:3'],
            'image'                 => ['nullable', 'image', 'mimes:jpg,jpeg,png', 'max:1024'],
        ],
        $message = [
            'name.required'         =>  ['এই ঘরটি পূরণ করুন'],
            'status.required'       =>  ['নিবার্চন করুন'],
            'status.not_in'         =>  ['নিবার্চন করুন'],
            'featured.required'     =>  ['নিবার্চন করুন'],
            'featured.not_in'       =>  ['নিবার্চন করুন'],
            // 'image.required'        =>  ['এই ঘরটি পূরণ করুন'],
            // 'image.mimes'           =>  ['সঠিক ফরমেট আপলোড করুন'],
            // 'image.max'             =>  ['২ এমবি এর বেশি আপলোড করা যাবে না'],
        ]);

        $service = new Ourservice;
        $service->name              =   $request->name;
        $service->slug              =   Str::slug($request->name);
        $service->desc              =   $request->description;
        $service->status            =   $request->status;
        $service->is_featured       =   $request->featured;

        if(!is_null($request->image)){
            $websitefavicondark = $request->file('image');
            if( !is_null($websitefavicondark) ){
                // Delete Existing Image
                if( File::exists('assets/images/service/' . $service->image) ) {
                    File::delete('assets/images/service/' . $service->image);
                }
                
                $img = rand() . '.' . $websitefavicondark->getClientOriginalExtension();
                $location = public_path('assets/images/service/' . $img);

                Image::make($websitefavicondark)->save($location);
                $service->image = $img;
            }
        }

        $service->save();

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
        $delete = Ourservice::where('id', $id)->delete();

        // check data deleted or not
        if ($delete == 1) {
            $success = true;
            $message = "ডিলেট সম্পন্ন হয়েছে!!!";
            if( File::exists('assets/images/sevice/' . $delete->image) ) {
                File::delete('assets/images/sevice/' . $delete->image);
            }
            
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
