<?php

namespace App\Http\Controllers\Admin;

use App\Models\ContactUs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ContactUsController extends Controller
{
    public function index()
    {
        $contactus = ContactUs::first();
        return view('admin.extras.contactus', compact('contactus'))
        ->render();
    }
    public function save(Request $request)
    {
        $response = array();
        $contactus = ContactUs::first();
        $contactus->update($request->all());
        $response['icon'] = 'success';
        $response['msg'] = 'Data Saved Successfully';
        return $response;
    }
}
