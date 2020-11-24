<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TopSellingMonth;

class TopSellingMonthController extends Controller
{
    public function editTopSellingMonth(Request $request)
    {
        $item = TopSellingMonth::where('item_id',$request->id)->first();
        if($item != []){
            $item->delete();
            return 'deleted';
        }else{
            TopSellingMonth::create(['item_id'=>$request->id]);
            return 'added';
        }
        
    }
}
