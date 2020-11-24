<?php

namespace App\Http\Controllers;

use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemTypeController extends Controller
{
    public function load(Request $request)
    {
        $brand = ProductBrand::find($request->brand_id);
        return view('user.navData', compact("brand"))->render();

    }
}
