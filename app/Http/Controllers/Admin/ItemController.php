<?php

namespace App\Http\Controllers\Admin;

use App\Models\Item;
use App\Models\ItemSize;
use App\Models\Image;
use App\Models\Product;
use App\Models\ProductType;
use App\Models\Flavour;
use App\Models\ItemVariant;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemController extends Controller
{
    public function index(Request $request)
    {
        $items = Item::all();
        $type = $request->type;
        $variants = ItemVariant::all();
        return view("admin.item.index", compact('items', 'type', 'variants'))
        ->render();
    }

    public function editItem(Request $request)
    {
        if($request->isMethod('get')){
            $item = Item::find($request->id);
            return view('admin.item.edit', compact('item'))
            ->render();
        }else if($request->isMethod('post')){
            $response = array();
            $item = Item::where('id', $request->item_id)->first();
            $item->quantity = $request->quantity;
            if($request->price){
                $item->price = $request->price;
            }
            $item->description = $request->description;
            $item->product_brand_id = $request->product_brand_id;
            $item->name = $request->name;
            $item->update();
            if($request->sale){
                $item->sale = $request->sale;
                $item->update();
            }
            if($item){
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Data Edited Successfully';
                if($request->images){
                    foreach($request->images as $image){
                        $path = $image->store('images', 'folder');
                        Image::create(['path'=>$path, 'item_id'=>$request->item_id]);
                    }
                    $image = Image::where('path', $item->images->first()->path)->first();
                    $item->image_id = $image->id;
                    $item->update();
                }
            }else{
                $response['icon'] = 'warning';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
            }
            return $response;
        }
    }

    public function deleteItem(Request $request)
    {
        $response = array();
        Item::where('id',$request->id)->delete();
        $response['icon'] = 'success';
        $response['msg'] = '&nbsp;&nbsp;&nbsp;Data Deleted Successfully';
        return $response;
    }

    public function addItem(Request $request)
    {
        if($request->isMethod('get')){
            $type = $request->type;
            $product = Product::where('name', $type)->first();
            $types = ProductType::where('product_id',  $product->id)->get();
            $variants = ItemVariant::all();
            return view("admin.item.create", compact('type', 'types', 'variants', 'product'))
            ->render();
        }else if($request->isMethod('post')){
            $response = array();
            $item = Item::create([
                'product_brand_id' => $request->product_brand_id,
                'name' => $request->name,
                'description' => $request->description,
                'quantity' => $request->quantity,
            ]);
            if($request->price){
                $item->price = $request->price;
                $item->update();
            }
            if($request->sale){
                $item->sale = $request->sale;
                $item->update();
            }
            if($item){
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Data Added Successfully';
                if($request->images){
                    foreach($request->images as $image){
                        $path = $image->store('images', 'folder');
                        Image::create(['path'=>$path, 'item_id'=>$item->id]);
                    }
                    $image = Image::where('path', $item->images->first()->path)->first();
                    $item->image_id = $image->id;
                    $item->update();
                }
            }else{
                $response['icon'] = 'warning';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;Something Went Wrong';
            }
            return $response;
        }
 
    }

    public function deleteItemImage(Request $request)
    {
        $image = Image::where('id', $request->id)->first();
        $image->delete();
    }
    public function deleteItemVariant(Request $request)
    {
        $var = \App\Models\ItemVariant::where('id', $request->id)->first();
        $var->delete();
    }

    public function addItemVariant(Request $request)
    {
        ItemVariant::create([
            'item_id' => $request->item_id,
            'name' => $request->name,
            'price' => $request->price,
            'sale' => $request->sale,
            'quantity' => $request->quantity
        ]);
    }
}
