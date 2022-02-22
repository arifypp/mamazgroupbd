<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;
use App\Models\User;
use App\Models\Backend\Gallery;
use App\Models\Backend\GalleryCategory;
use App\Models\Backend\GalleryTitle; 
use Response;
use Session;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $cattitle = GalleryTitle::find(1);
        return view('Backend.gallery.manage', compact('cattitle'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('Backend.gallery.create');
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
            'catID' =>  ['required', 'not_in:0'],
            'file' => ['required'],
        ],
        $message = [
            'file.required' =>  'ফটো আপলোড করুন!',
            'catID.required' =>  'ক্যাটাগড়ি নির্বাচন করুন!',
            'catID.not_in' =>  'ক্যাটাগড়ি নির্বাচন করুন!',
        ]);


        $file = new Gallery;

        $file->gallaryscatid = $request->catID;

        if ($request->file('file')) {
            $filePath = $request->file('file');
            $fileName = $filePath->getClientOriginalName();
            $path = $request->file('file')->storeAs('uploads', $fileName, 'public');
          }
    
          $file->image = '/storage/'.$path;
          $file->save();

         return Response::json(array('success' => true, 'message' => 'Successfully uploaded file.'), 200);

        
        //   return response()->json(['success' =>true, 'message'=> 'ফটো অ্যাড করা সম্পন্ন হয়েছে!!!']);


    }


        // Category store 
    public function storecat(Request $request)
    {
        $request->validate([
            'name'      =>  'required',
        ],
        $message = [
            'name.required'     =>   'ক্যাটাগরি নাম লিখুন',
        ]);

        $cat = new GalleryCategory;

        $cat->name      =   $request->name;

        $cat->save();

        $notification = array(
            'message'       => 'ক্যাটাগড়ি তৈরি করা সম্পন্ন হয়েছে!!!',
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
        $cattitle = GalleryTitle::find($id);

        if( !empty($cattitle) ){
            $cattitle->title    = $request->title;
            $cattitle->desc    =  $request->desc;

            $cattitle->save();

            $notification = array(
                'message'       => 'ক্যাটাগড়ি টাইটেল আপডেট সম্পন্ন হয়েছে!!!',
                'alert-type'    => 'success'
            );
            return back()->with($notification);

        }
    }

    public function remove(Request $request)
    {
        $name =  $request->get('id');
        Gallery::where(['id' => $name])->delete();

        return $name;
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
