<?php

namespace App\Http\Controllers;

use App\Models\TopSellingWeek;
use Illuminate\Http\Request;

class TopSellingWeekController extends Controller
{
    public function editTopSellingWeek(Request $request)
    {
        $item = TopSellingWeek::where('item_id',$request->id)->first();
        if($item != []){
            $item->delete();
            return 'deleted';
        }else{
            TopSellingWeek::create(['item_id'=>$request->id]);
            return 'added';
        }
        
    }
}
