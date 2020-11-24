<?php

namespace App\Http\Controllers;
use App\Models\Gallery;
use App\Models\Image;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    public function uploadImage(Request $request)
    {
        $response = array();
        if($request->images){
            if($request->images){
                foreach($request->images as $image){
                    $path = $image->store('images', 'folder');
                    $image = Image::create(['path'=>$path]);
                    Gallery::create(['image_id'=>$image->id]);
                }
            }
            $response['icon'] = 'success';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Gallery Images Sucessfully';
        }else{
            $response['icon'] = 'error';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Something Went Wrong';
        }
        return $response;
    }

    public function index()
    {   
        $images = Gallery::all();
        return view('gallery.index', compact('images'));
    }

    public function deleteGalleryImage($id)
    {
        $response = array();
        Gallery::where('id',$id)->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Deleted Successfully';
        return $response;
    }
}
