<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
class WishlistController extends Controller
{
    public function addToWishList(Request $request)
    {
        // return $request->all();
        if($wishlist = Wishlist::where('user_id', auth()->user()->id)
                ->where('item_id', $request->item_id)
                ->where('variant_id', $request->variant_id)
                ->first()
            ){
            $wishlist->quantity += $request->quantity;
            $wishlist->update();
            return 'updated';
        }else{
            $wishlist = new Wishlist();
            $wishlist->quantity = $request->quantity;
            $wishlist->item_id = $request->item_id;
            $wishlist->user_id = auth()->user()->id;
            if($request->variant_id){
                $wishlist->variant_id = $request->variant_id;
            }
            $wishlist->save();
            return 'created';
        }
    }

    public function removeFromWishlist(Request $request)
    {
        $wishlist = Wishlist::find($request->id);
        $wishlist->delete();
    }
}
