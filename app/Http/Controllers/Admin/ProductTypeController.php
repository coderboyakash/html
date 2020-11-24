<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductType;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductTypeController extends Controller
{
    public function addProductType(Request $request)
    {
        if($request->isMethod('get')){
            $types = array();
            $products = Product::all();
            $types = ProductType::all();
            return view("admin.productType.create", compact('products', 'types'))
            ->render();
        }else if($request->isMethod('post')){
            $response = array();
            $product_type = ProductType::create([
                'name' => $request->name,
                'product_id' => $request->product_id,
            ]);
            if($request->sub_menu){
                ProductBrand::create([
                    'name' => $request->sub_menu_name,
                    'product_type_id' => $product_type->id,
                ]);
                \App\Models\SubMenu::create([
                    'product_type_id' =>  $product_type->id,
                    'is_exsits' => 1
                ]);
            }else{
                ProductBrand::create([
                    'name' => $request->name,
                    'product_type_id' => $product_type->id,
                ]);
                \App\Models\SubMenu::create([
                    'product_type_id' =>  $product_type->id,
                    'is_exsits' => 0
                ]);
            }
            if($product_type){
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Product Type Added';
            }else{
                $response['icon'] = 'warning';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
            }
            return $response;
        }

    }

    public function editProductType(Request $request)
    {
        $response = array();
        if($request->isMethod('get')){
            $types = array();
            $products = Product::all();
            $type = ProductType::find($request->id);
            return view("admin.productType.edit", compact('products', 'type'))
            ->render();
        }else if($request->isMethod('post')){
            $type = ProductType::find($request->id);
            $type->name = $request->name;
            if($request->product_id != null){
                $type->product_id = $request->product_id;
            }
            $type->save();
            if($request->sub_menu){
                $menu = \App\Models\SubMenu::find($request->id);
                $menu->product_type_id =  $type->id;
                $menu->is_exsits = 1;
                $menu->update();
            }else{
                $menu = \App\Models\SubMenu::find($request->id);
                $menu->product_type_id =  $type->id;
                $menu->is_exsits = 0;
                $menu->update();
            }
            $response['icon'] = 'success';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;Product Category Updated';
        }
        return $response;
    }

    public function deleteProductType(Request $request)
    {
        $response = array();
        ProductType::where('id',$request->id)->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;Data Deleted Successfully';
        return $response;
    }

    public function getProductType(Request $request)
    {
        $product_types = ProductType::where('product_id', $request->product_id)->get();
        $data = "<option value='null'>Select Product Type</option>";
        foreach($product_types as $type){
            $data .= "<option value=".$type->id.">".$type->name."</option>";
        }
        return $data;
    }
}
