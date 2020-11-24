<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\FeaturedArrival;
use Illuminate\Http\Request;

class FeaturedArrivalController extends Controller
{
    public function editFeaturedArrival(Request $request)
    {
        $item = FeaturedArrival::where('item_id',$request->id)->first();
        if($item != []){
            $item->delete();
            return 'deleted';
        }else{
            FeaturedArrival::create(['item_id'=>$request->id]);
            return 'added';
        }
        
    }
}
