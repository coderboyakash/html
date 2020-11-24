<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductBrand;
use App\Models\Item;
use App\Models\ItemType;
use App\Http\Controllers\Controller;
use App\Models\ContactUs;
use App\Models\ProductType;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function showProduct(Request $request)
    {
        $item = Item::where('id',$request->id)->first();
        $products = Product::all();
        $contactus = ContactUs::first();
        foreach( $products as $product ) {
            if($product->types){
            foreach($product->types as $type) {
                if($type->brands){
                foreach($type->brands as $brand){
                    if($brand->items){
                    if(isset($items)){
                        $tab_items = $tab_items->merge($brand->items);
                    }else{
                        $tab_items = $brand->items;
                    }
                }
                }
                }
            }
        }
        }
        return view('user.product', compact('products', 'item', 'contactus', 'tab_items'));
    }
    public function showProductsWithProductName(Request $request, $name, $id)
    {
        $products = Product::all();
        $product = Product::find($id);
        foreach($product->types as $type){
            foreach($type->brands as $brand) {
                $tem = $brand;
                if(isset($items)){
                    $items = $items->merge($brand->items);
                }else{
                    $items = $brand->items;
                }
            }
        }
        $type_id = $type->id;
        $contactus = ContactUs::first();
        $check_id = 0;
        return view('user.products', compact('products', 'items', 'contactus', 'type_id', 'brand', 'check_id'));
    }
    public function showProducts(Request $request)
    {
        $products = Product::all();
        $brand = ProductBrand::where('id', $request->id)->first();
        $type = $brand->type;
        $type_id = $brand->id;
        foreach($brand->type->brands as $brand){
            if(!isset($items)){
                $items = $brand->items;
            }else{
                $items = $items->merge($brand->items);
            }
        }
        $brand = ProductBrand::find($request->id);
        $check_id = $brand->id;
        $contactus = ContactUs::first();
        return view('user.products', compact('products', 'items', 'contactus', 'brand', 'type_id', 'check_id'));
    }
    public function getFilteredProducts(Request $request)
    {
        $array = array();
        $ids = array_keys($request->all());
        foreach($ids as $id){
            if(is_numeric($id)){
                array_push($array, $id);
                if(isset($items)){
                    $items = $items->merge(Item::where('product_brand_id', $id)->get());
                }else{
                    $items = Item::where('product_brand_id', $id)->get();
                }
            }
        }
        $min = $request->min;
        $max = $request->max;
        return view("user.filteredProducts", compact('items', 'min', 'max'))
        ->render();
    }

    public function getSearchedProducts(Request $request)
    {
        $items = Item::where('name', 'like', '%' . $request->item_name . '%')->get();
        $contactus = \App\Models\ContactUs::first();
        $aboutus = \App\Models\AboutUs::first();
        $products = \App\Models\Product::all();
        $item_brand_filter_id = $request->item_brand_id;
        return view("user.getSearchedProducts", compact('items', 'contactus', 'aboutus', 'products', 'item_brand_filter_id'))
        ->render();
    }

    public function getFilteredBrandProducts(Request $request)
    {
        $brand = ProductBrand::find($request->brand);
        foreach($brand->itemtypes as $itemtype){
            foreach($itemtype->items as $item){
                if(isset($data)){
                    $data = $data->merge(Item::where('id', $item->id)->get());
                }else{
                    $data = Item::where('id', $item->id)->get();
                }
            }
        }
        if(isset($data)){
            $items = $data;
        }else{
            $items = [];
        }
        return view("user.filteredProducts", compact('items'))
        ->render();
    }

    public function getFilteredItemtype(Request $request)
    {
        $brand = ProductBrand::find($request->brand);
        $itemtypes = $brand->itemtypes;
        return view("user.filteredItemTypes", compact('itemtypes'))
        ->render();
    }

    public function getPrice(Request $request)
    {
        $tab_item = \App\Models\ItemVariant::find($request->id);
        if($tab_item->sale){
            return (($tab_item->sale*$tab_item->price)/100);
        }else{
            return $tab_item->price;
        }
        // $price = $tab_item->sale ? $tab_item->price-(($tab_item->sale*$tab_item->price)/100) : $tab_item->price;
        // return $price;
    }
}
