<?php

namespace App\Http\Controllers\Admin;

use App\Models\SiteSetting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SiteSettingController extends Controller
{
    public function index()
    {
        $sitesetting = SiteSetting::first();
        return view('admin.extras.sitesetting', compact('sitesetting'))
        ->render();
    }

    public function save(Request $request)
    {
        $response = array();
        $sitesetting = SiteSetting::first();
        $sitesetting->update($request->all());
        $response['icon'] = 'success';
        $response['msg'] = 'Data Saved Successfully';
        return $response;
    }
}
