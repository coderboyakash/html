<?php

namespace App\Http\Controllers\Admin;

use App\Models\AboutUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AboutUsController extends Controller
{
    public function index()
    {   
        $aboutus = AboutUs::first();
        return view('admin.extras.aboutus', compact('aboutus'))
        ->render();
    }

    public function save(Request $request)
    {
        // return $request->all();
        $response = array();
        $aboutus = AboutUs::first();
        $aboutus->update($request->all());
        $response['icon'] = 'success';
        $response['msg'] = 'Data Saved Successfully';
        return $response;
    }
}
