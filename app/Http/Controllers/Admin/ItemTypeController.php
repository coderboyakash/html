<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ItemType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemTypeController extends Controller
{
    public function deleteItemType(Request $request)
    {
        $response = array();
        ItemType::where('id',$request->id)->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;Data Deleted Successfully';
        return $response;
    }
    
    public function addItemType(Request $request)
    {
        if($request->isMethod('get')){
            $products = Product::all();
            $itemtypes = ItemType::all();
            return view("admin.itemType.create", compact('products', 'itemtypes'))
            ->render();
        }else if($request->isMethod('post')){
            $response = array();
            $itemtype = ItemType::create([
                'item_type' => $request->item_type,
                'product_brand_id' => $request->product_brand_id
            ]);
            if($itemtype){
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Item type Added';
            }else{
                $response['icon'] = 'warning';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
            }
            return $response;
        }
    }
    public function editItemType(Request $request)
    {
        if($request->isMethod('get')){
            $products = Product::all();
            $itemtype = ItemType::find($request->id);
            return view("admin.itemType.edit", compact('products', 'itemtype'))
            ->render();
        }else if($request->isMethod('post')){
            $response = array();
            $itemtype = ItemType::find($request->id);
            $itemtype->item_type = $request->item_type;
            $itemtype->product_brand_id = $request->product_brand_id;
            $itemtype->update();
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Item Type Updated';
            return $response;
        }
    }

    public function getItemType(Request $request)
    {
        $itemtypes = ItemType::where('product_brand_id', $request->product_brand_id)->get();
        $data = "<option value='null'>Select Item Type</option>";
        foreach($itemtypes as $itemtype){
            $data .= "<option value=".$itemtype->id.">".$itemtype->item_type."</option>";
        }
        return $data;
    }
}
