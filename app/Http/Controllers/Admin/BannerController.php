<?php

namespace App\Http\Controllers\Admin;
use App\Models\Banner;
use App\Models\SmallBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BannerController extends Controller
{
    public function uploadBanner(Request $request)
    {
        $response = array();
        if($request->image){
            $path = $request->image->store('images', 'folder');
            Banner::create(['path'=>$path]);
            $response['icon'] = 'success';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Banner Uploaded Sucessfully';
            return $response;
        }else{
            $response['icon'] = 'error';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Something Went Wrong';
            return $response;
        }
        
    }


    public function showBanners()
    {
        $banners = Banner::all();
        return view("admin.banners.index", compact('banners'))
        ->render();
    }
    public function addBanner()
    {
        return view("admin.banners.create")
        ->render();
    }

    public function deleteBanner(Request $request)
    {
        $response = array();
        $banner = Banner::find($request->id);
        $banner->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Banner Deleted Sucessfully';
        return $response;
    }
    public function uploadSmallBanner(Request $request)
    {
        $response = array();
        if($request->image1 && $request->image2 && $request->image3){
            $path1 = $request->image1->store('images', 'folder');
            $path2 = $request->image2->store('images', 'folder');
            $path3 = $request->image3->store('images', 'folder');
            $path = $path1.','.$path2.','.$path3;
            $link = $request->link1.','.$request->link2.','.$request->link3;
            SmallBanner::create(['path'=>$path, 'link'=>$link, 'layout_id'=>$request->layout_id]);
            $response['icon'] = 'success';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Banner Uploaded Sucessfully';
            return $response;
        }else{
            $response['icon'] = 'error';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Something Went Wrong';
            return $response;
        }
        
    }


    public function showSmallBanners()
    {
        $smallbanners = SmallBanner::all();
        return view("admin.sBanners.index", compact('smallbanners'))
        ->render();
    }
    public function addSmallBanner()
    {
        return view("admin.sBanners.create")
        ->render();
    }

    public function deleteSmallBanner(Request $request)
    {
        $response = array();
        $banner = SmallBanner::find($request->id);
        $banner->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Banner Deleted Sucessfully';
        return $response;
    }
}
