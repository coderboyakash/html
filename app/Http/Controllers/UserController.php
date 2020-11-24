<?php

namespace App\Http\Controllers;
use App\Models\Item;
use App\Models\Banner;
use App\Models\AboutUs;
use App\Models\Product;
use App\Models\User;
use App\Models\ContactUs;
use App\Models\SmallBanner;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ServiceBanner;
use App\Models\TopSellingMonth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\ContactUsMail;
use Illuminate\Support\Facades\Mail;
class UserController extends Controller
{
    public function index()
    {
        $banners = Banner::all();
        $products = Product::all();
        $contactus = ContactUs::first();
        $smallbanners = SmallBanner::all();
        foreach( $products as $product ) {
            foreach($product->types as $type) {
                foreach($type->brands as $brand){
                    if(isset($items)){
                        $tab_items = $tab_items->merge($brand->items);
                    }else{
                        $tab_items = $brand->items;
                    }
                }
            }
        }
        $tab_items = Item::all();
        $servicebanners = ServiceBanner::all();
        $tsm = TopSellingMonth::skip(3)->take(3)->get();
        return view('user.index', compact('banners', 'products', 'contactus', 'smallbanners', 'tab_items', 'servicebanners', 'tsm'));
    }
    public function login()
    {
        $banners = Banner::all();
        $products = Product::all();
        $contactus = ContactUs::first();
        return view('user.login', compact('banners', 'products', 'contactus'));
    }

    public function userLogin(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // Authentication passed...
            return redirect()->intended('dashboard');
        }
    }

    public function aboutUs()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::first();
        return view('user.about', compact('products', 'contactus', 'aboutus'));
    }

    public function dashboard()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::first();
        return view('user.dashboard', compact('products', 'contactus', 'aboutus'));
    }

    public function editProfile()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::first();
        return view('user.editProfile', compact('products', 'contactus', 'aboutus'));
    }

    public function updateProfile(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->username= $request->username;
        $user->email= $request->email;
        $user->update();
        return redirect()->back();
    }

    public function updatePassword(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        if($user->password == Hash::make($request->oldpassword)) {
            $user->password = Hash::make($request->newpassword);
            $user->update();
        }
        return redirect()->back();
    }

    public function updateInfo(Request $request)
    {
        $user = User::where('id', $request->id)->first();
        $user->address= $request->address;
        $user->phone= $request->phone;
        $user->city= $request->city;
        $user->provison= $request->provison;
        $user->country= $request->country;
        $user->postal_code= $request->postal_code;
        $user->update();
        return redirect()->back();
    }

    public function purchaseHistory()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::first();
        return view('user.purchaseHistory', compact('products', 'contactus', 'aboutus'));
    }

    public function wishlist()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::first();
        return view('user.wishlist', compact('products', 'contactus', 'aboutus'));
    }

    public function terms()
    {
        $products = Product::all();
        $contactus = ContactUs::first();
        $aboutus = AboutUs::first();
        return view('user.terms', compact('products', 'contactus', 'aboutus'));
    }

    public function getCities(Request $request)
    {
        $data = '';
        $country = \App\Models\Country::find($request->country_id);
        $cities = $country->cities;
        foreach($cities as $city){
            $data .= "<option value=".$city->city_name."> ".$city->city_name."</option>";
        }
        return $data;
    }

    public function userContact(Request $request)
    {
        $data = array(
            'name' => $request->name,
            'email' => $request->email,
            'message' => $request->message,
        );
        Mail::to($request->email)->send(new ContactUsMail($data));
        return redirect()->back();
    }
}
