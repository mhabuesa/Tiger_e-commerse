<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    function cart_store( Request $request, $product_id){
        $request->validate([
            'color_id'=>'required',
            'size_id'=>'required',
            'quantity'=>'required',
        ]);

        Cart::insert([
            'customer_id'=>Auth::guard('customer')->id(),
            'product_id'=>$product_id,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
            'quantity'=>$request->quantity,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('added', 'Product Added to Cart');
    }

    function cart(){
        $carts = Cart::where('customer_id', Auth::guard('customer')->id())->get();
        return view('frontend.cart.cart',[
            'carts'=>$carts,
        ]);
    }


    function cart_remove($id){
        Cart::find($id)->delete();
        return back();
    }


    function cart_update(Request $request){


        foreach($request->quantity as $cart_id=> $quantity){
            Cart::find($cart_id)->update([
                'quantity'=>$quantity,
            ]);
        }

        return back();
    }


}
