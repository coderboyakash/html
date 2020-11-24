<?php

namespace App\Http\Controllers\Admin;

use auth;
use App\Models\User;
use App\Models\Visit;
use App\Models\Payment;
use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function dashboard()
    {
        $products = Product::all();
        $users = User::all();
        $visits = Visit::all();
        $payments = Payment::all();
        return view('admin.dashboard', compact('products', 'users', 'visits', 'payments'))
        ->render();
    }

    public function login()
    {
        return view('admin.login');
    }

    public function adminLogOut()
    {
        auth()->logout();
        return redirect()->intended('admin/login');
    }

    public function showUsers()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'))
        ->render();
    }

    public function changeUserStatus($id)
    {
        $user = User::find($id);
        $status = $user->is_active ? '0' : '1';
        $user->is_active = $status;
        $user->save();
    }

    public function changePassword(Request $request)
    {
        $response = array();
        if($request->isMethod('get')){
            return view('admin.extras.changePassword')
            ->render();
        }else if($request->isMethod('post')){
            $password = Hash::make($request->password);
            $user = User::where('id', auth()->user()->id)->first();
            try {
                $user->password = $password;
                $user->username = $request->username;
                $user->update();
                $response['icon'] = 'success';
                $response['msg'] = '&nbsp;&nbsp;&nbsp;&nbsp;Password Updated Sucessfully';
                return $response;
            } catch (\Throwable $th) {
                $response['icon'] = 'warning';
                $response['msg'] = 'Something Went Wrong';
                return $response;
            }
        }
    }
}
