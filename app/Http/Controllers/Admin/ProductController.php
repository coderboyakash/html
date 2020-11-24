<?php

namespace App\Http\Controllers\Admin;
use App\Models\Item;
use App\Models\Image;
use App\Models\ItemType;
use App\Models\ProductType;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{


    public function edit(Request $request)
    {
        $item = Item::where('id', $request->id)->first();
        return view("admin.product.edit", compact('item'))
        ->render();
    }

    public function uploadMultipleFilesForm(Request $request)
    {
        return view('admin.product.create.ProductImages')
        ->render();
    }
    public function uploadMultipleFiles(Request $request)
    {
        $response = array();
        foreach($request->images as $image){
            $path = $image->store('images', 'folder');
            $image = Image::create(['path'=>$path]);
        }
        if($image){
            $response['icon'] = 'success';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;Images Uploaded Sucessfully';
        }else{
            $response['icon'] = 'warning';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
        }
        return $response;
    }

    public function validateProduct($data)
    {
        $validator = Validator::make($data, [
            'name' => 'bail|required',
        ]);
        return $validator;
    }

    public function addProduct(Request $request)
    {
        if($request->isMethod('post')){
            $response = array();
            if($this->validateProduct($request->all())->fails()){
                $response['icon'] = 'warning';
                $response['errors'] = $this->validateProduct($request->all())->errors();
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
                return response()->json($response, 200);
            }
            try {
                 $product = Product::create(['name'=>$request->name]);
                if($request->icon){
                    $path = $request->icon->store('images', 'folder');
                    $product->icon_path=$path;
                    $product->update();
                }
                if($request->only_menu){
                    $type = \App\Models\ProductType::create(['name'=>$product->name, 'product_id'=>$product->id]);
                    $brand = \App\Models\ProductBrand::create(['name'=>$type->name, 'product_type_id'=>$type->id]);
                    $onlymenu = \App\Models\OnlyProduct::create(['product_id'=>$product->id, 'is_exsits'=>1]);
                }
                
                $onlymenu = \App\Models\OnlyProduct::create(['product_id'=>$product->id, 'is_exsits'=>0]);
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Product Added Sucessfully';
            } catch (\Throwable $th) {
                $response['icon'] = 'warning';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
            }
            return $response;
        }else if($request->isMethod('get')){
            $products = Product::all();
            return view('admin.product.create', compact('products'))
            ->render();
        }
    }


    public function deleteProduct(Request $request)
    {
        $response = array();
        Product::where('id',$request->id)->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;Data Deleted Successfully';
        return $response;
    }

    public function editProduct(Request $request)
    {
        if($request->isMethod('post')){
            $response = array();
            $product = Product::find($request->id);
            $product->name = $request->name;
            if($request->image){
                $path = $request->icon->store('images', 'folder');
                $product->icon_path = $path;
            }
            $product->update();
            $response['icon'] = 'success';
            $response['msg'] = '&nbsp;&nbsp;&nbsp;Data Updated Successfully';
            return $response;
        }else if($request->isMethod('get')){
            $product = Product::find($request->id);
            return view('admin.product.edit', compact('product'))
            ->render();
        }
    }
}
