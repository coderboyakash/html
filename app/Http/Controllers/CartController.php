<?php

namespace App\Http\Controllers;
use App\Models\Cart;
use App\Models\Item;
use App\Models\AboutUs;
use App\Models\Product;
use App\Models\Payment;
use App\Models\ContactUs;
use App\Models\DeliveryProcess;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class CartController extends Controller
{
    public function addToCart(Request $request)
    {
        if($cart = Cart::where('user_id', auth()->user()->id)
                ->where('item_id', $request->item_id)
                ->where('variant_id', $request->variant_id)
                ->first()
            ){
            $cart->quantity += $request->quantity;
            $cart->update();
            return 'Item Added To Cart';
        }else{
            $cart = new Cart();
            $cart->quantity = $request->quantity;
            $cart->item_id = $request->item_id;
            $cart->user_id = auth()->user()->id;
            if($request->variant_id){
                $cart->variant_id = $request->variant_id;
            }
            $cart->save();
            return "Cart Updated";
        }
        // $item_found = False;
        // if(($carts = Cart::where('item_id',$request->item_id)->where('user_id', 1)->get())!='[]'){
        //     // item found
        //     foreach($carts as $cart){
        //         if(($cart->item_id == $request->item_id) && ($cart->size_id == $request->size_id) && ($cart->color_id == $request->color_id) && ($cart->flavour_id == $request->flavour_id) && ($cart->strength_id == $request->strength_id)){
        //             $item_found = True;
        //             $item = $cart;
        //         }
        //     }
        // }
        // if($item_found){
        //     if($request->quantity){
        //         $cart->quantity += $request->quantity;
        //     }else{
        //         $cart->quantity += 1;
        //     }

        //     $cart->update();
        // }else{ 
        //     $cart = new Cart();
        //     $cart->quantity = 1;
        //     $cart->item_id = $request->item_id;
        //     $cart->user_id = 1;
        //     if($request->size_id){
        //         $cart->size_id = $request->size_id;
        //     }
        //     if($request->color_id){
        //         $cart->color_id = $request->color_id;
        //     }
        //     $cart->save();
        // }
    }

    public function showCart()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::all();
        return view('user.cart', compact('products', 'aboutus', 'contactus'));
    }
    public function paymentMethods(Request $request)
    {
        $data = $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'country' => 'required',
            'city' => 'required',
            'email' => 'email|required',
            'zip_code' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'state' => 'required',
            'del_type_id' => 'required'
        ]);
        $deliveryProcess_id = $request->del_type_id;
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::all();
        $payment = new \App\Models\Payment();
        $payment->state = $request->state;
        $payment->email = $request->email;
        $payment->fname = $request->fname;
        $payment->lname = $request->lname;
        $payment->address = $request->address;
        $payment->phone = $request->phone;
        $payment->zip_code = $request->zip_code;
        $payment->city = $request->city;
        $payment->provison = $request->state;
        $country = \App\Models\Country::find($request->country);
        $payment->country = $country->country_name;
        $payment->delivery_mode_id = $request->del_type_id;
        $payment->user_id = auth()->user()->id;
        $payment->save();
        $payment_id = $payment->id;
        return view('user.paymentMethod', compact('products', 'aboutus', 'contactus', 'deliveryProcess_id', 'payment_id'));
    }
    public function deliveryMethods()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::all();
        $deliveryProcesses = DeliveryProcess::all();
        return view('user.deliveryMethods', compact('products', 'aboutus', 'contactus', 'deliveryProcesses'));
    }
    public function paymentConfirmed()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::all();
        return view('user.paymentConfirmed', compact('products', 'aboutus', 'contactus'));
    }

    public function removeFromCart(Request $request)
    {
        try {
            $cart = Cart::where('id', $request->id)->first();
            $cart->delete();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function changeCartItemQuantity(Request $request)
    {
        try {
            $cart = Cart::where('id', $request->id)->first();
            $cart->quantity = $request->quantity;
            $cart->update();
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
