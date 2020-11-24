<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpecialArrival;

class SpecialArrivalController extends Controller
{
    public function editSpecialArrival(Request $request)
    {
        $item = SpecialArrival::where('item_id',$request->id)->first();
        if($item != []){
            $item->delete();
            return 'deleted';
        }else{
            SpecialArrival::create(['item_id'=>$request->id]);
            return 'added';
        }
        
    }
}
