<?php

use App\Models\Item;
use App\Models\ItemColor;
use App\Models\ItemVariant;
use App\Models\ItemSize;
use App\Models\ItemStrength;
    if(!function_exists('random_code')){
        function random_code(){
            return rand(111,999);
        }
    }


    function getProductPriceRange($id)
    {
        $max = 0;
        $min = 0;
        $item = Item::find($id);
        $max = $item->price;
        $min = $item->price;
        if(($item->variants != '[]')){
            $items = ItemVariant::where('item_id', $id)->get();
            foreach($items as $item){
                if($item->price > $max){
                    $max = $item->price;
                }
            }
            foreach($items as $item){
                if($item->price < $min){
                    $min = $item->price;
                }
            }
        }
        $range = 'From '.'£'.$min .' - '.'£'.$max;
        if($min == $max){
            return '';
        }
        return $range;
    }

?>