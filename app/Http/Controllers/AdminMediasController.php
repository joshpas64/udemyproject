<?php

namespace App\Http\Controllers;

use File;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Photo;

class AdminMediasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $photos = Photo::all();

        return view('admin.media.index',compact('photos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('admin.media.create');
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

        $data = $request->all();
        $success = false;
        if($file = $request->file('file')){
            $fileName = time() . '_' . $file->getClientOriginalName();

            $file->move(Photo::getPhotoDir(),$fileName);

            $photo   = Photo::create(['file'=>$fileName]);
            $success = true;
        }

        return redirect()->route('admin.media.index');
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

    public function deleteMedia(Request $request){
        // if(isset($request->delete_single)){
        //     $id = $request->photo_id;
        //     $photo = Photo::findOrFail($id);
            
        //     $path = $photo->file;

        //     if(File::exists(public_path() . $path)){
        //         unlink(public_path() . $path);
        //     }

        //     $photo->delete();
        //     return redirect()->back();
        // }

        if(isset($request->delete_all) && !empty($request->checkBoxArray)){

            $photos = Photo::findOrFail($request->checkBoxArray);
            foreach($photos as $photo){
                $photo->delete();
            }

            return redirect()->back();
        } else {
            return redirect()->back();
        }


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
        $photo = Photo::findOrFail($id);

        $path = $photo->file;

        if(File::exists(public_path() . $path)){
            unlink(public_path() . $path);
        }

        $photo->delete();

        return redirect()->route('admin.media.index');
    }
}
