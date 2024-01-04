<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\color;
use App\Models\size;
use Carbon\Carbon;
use Illuminate\Http\Request;


class VariationController extends Controller
{
    function variation(){
        $categories = Category::all();
        return view('admin.variation.variation', compact('categories'));
    }


    function color_store(Request $request ){
        $request->validate([
            'color_name'=>'required',
        ]);

        color::insert([
            'color_name'=>$request->color_name,
            'color_code'=>$request->color_code,
            'created_at'=>Carbon::now(),
        ]);
        return back()->with('color_success', 'Color Added Successfully');

    }

    function color_delete($id){
        color::find($id)->delete();
        return back()->with('color_delete', 'Color Deleted Successfully');
    }


    function size_store(Request $request){
       $sizes =  $request->size;
       $category_id = $request->category_id;

       foreach($sizes as $key=> $size){


        size::insert([
            'category_id'=>$category_id,
            'size'=>$sizes[$key],
            'created_at'=>Carbon::now(),
        ]);
       }
       return back()->with('size', 'Size Insert Successfully');
    }

    function size_delete($id){
        size::find($id)->delete();
        return back()->with('size_delete', 'Size Deleted Successfully');
    }



}
