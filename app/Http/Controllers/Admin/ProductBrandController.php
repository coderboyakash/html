<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\ProductBrand;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductBrandController extends Controller
{
    public function deleteProductBrand(Request $request)
    {
        $response = array();
        ProductBrand::where('id',$request->id)->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;Data Deleted Successfully';
        return $response;
    }
    
    public function getProductBrand(Request $request)
    {
        $brands = ProductBrand::where('product_type_id', $request->product_type_id)->get();
        $data = "";
        foreach($brands as $brand){
            $data .= "<option value=".$brand->id.">".$brand->name."</option>";
        }
        return $data;
    }

    public function addProductBrand(Request $request)
    {
        if($request->isMethod('get')){
            $types = array();
            $products = Product::all();
            foreach($products as $product){
                foreach($product->types as $type){
                    $types[] = $type;
                }
            }
            $brands = ProductBrand::all();
            return view("admin.productBrand.create", compact('products', 'types', 'brands'))
            ->render();
        }else if($request->isMethod('post')){
            $response = array();
            $brand = ProductBrand::create($request->all());
            if($brand){
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Product Brand Added';
            }else{
                $response['icon'] = 'warning';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
            }
            return $response;
        }
    }

    public function editProductBrand(Request $request)
    {
        if($request->isMethod('get')){
            $brand = ProductBrand::find($request->id);
            $products = Product::all();
            return view("admin.productBrand.edit", compact('brand','products'))
            ->render();
        }else if($request->isMethod('post')){
            $response = array();
            $brand = ProductBrand::find($request->id);
            $brand->product_type_id = $request->product_type_id;
            $brand->name = $request->name;
            $brand->update();
            if($brand->update()){
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Product Brand Updated';
            }else{
                $response['icon'] = 'warning';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
            }
            return $response;
        }
    }
}
