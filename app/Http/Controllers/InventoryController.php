<?php

namespace App\Http\Controllers;

use App\Models\color;
use App\Models\inventory;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class InventoryController extends Controller
{
    function inventory($id){
        $product = product::find($id);
        $colors = color::all();
        $inventories = inventory::where('product_id', $id)->get();
        return view('admin.product.inventory',[
            'product'=>$product,
            'colors'=>$colors,
            'inventories'=>$inventories,
        ]);
    }


    function inventory_store(Request $request, $id){

        $colors = $request->color_id;
        $sizes = $request->size_id;
        $quantities = $request->quantity;

        if(Inventory::where('product_id', $id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->exists()){

 foreach( $colors as $key=> $color){
            Inventory::where('product_id', $id)->where('color_id', $colors[$key])->where('size_id', $sizes[$key])->increment('quantity', $quantities[$key]);

 }
            return back()->with('inventory_store','Inventory Stored Successfully');
        }

        foreach( $colors as $key=> $color){
            Inventory::insert([
                'product_id'=>$id,
                'color_id'=>$colors[$key],
                'size_id'=>$sizes[$key],
                'quantity'=>$quantities[$key],

            ]);
        }
        return back()->with('inventory_store','Inventory Stored Successfully');
    }


    function inventory_delete($id){
        inventory::find($id)->delete();
        return back()->with('inventory_delete', 'Inventory Deleted Successfully');
    }
}
