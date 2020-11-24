<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\ServiceBanner;
use App\Http\Controllers\Controller;

class ServiceBannerController extends Controller
{
    public function show()
    {
        $servicebanners = ServiceBanner::all();
        return view('admin.serviceBanner.index', compact('servicebanners'))
        ->render();
    }

    public function add(Request $request)
    {
        $response = array();
        if($request->isMethod('get')){
            return view('admin.serviceBanner.create')
            ->render();
        }else if($request->isMethod('post')){
            if($request->image){
                $path = $request->image->store('images', 'folder');
            }
            ServiceBanner::create([
                'title' => $request->title,
                'body' => $request->body,
                'image_path' => $path,
            ]);
            $response['icon'] = 'success';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;Service Banner Added Successfully';
        }
        return $response;
    }

    public function edit(Request $request)
    {
        $response = array();
        if($request->isMethod('get')){
            $servicebanner = ServiceBanner::find($request->id);
            return view('admin.serviceBanner.edit', compact('servicebanner'))
            ->render();
        }else if($request->isMethod('post')){
            $servicebanner = ServiceBanner::find($request->id);
            $servicebanner->title = $request->title;
            $servicebanner->body = $request->body;
            if($request->image){
                $path = $request->image->store('folder', 'images');
                $servicebanner->image_path = $path;
            }
            $servicebanner->update();
            $response['icon'] = 'success';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;Service Banner Updated Successfully';        
            return $response;    
        }
    }

    public function delete(Request $request)
    {
        $response = array();
        ServiceBanner::where('id',$request->id)->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;Service Banner Deleted Successfully';        
        return $response;    
    }
}
