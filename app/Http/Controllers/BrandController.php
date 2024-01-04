<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class BrandController extends Controller
{
    function brand(){
        $brands = Brand::all();
        return view('admin.brand.brand',[
            'brands'=>$brands
        ]);
    }

    function brand_store(Request $request){
        $request->validate([
            'brand_name'=>'required',
            'brand_logo'=>'required',
        ]);

        $logo = $request->brand_logo;
        $extension = $logo->extension();
        $file_name = Str::lower(str_replace(' ','-',$request->brand_name)).'.'.$extension;
        Image::make($logo)->save(public_path('uploads/brand/'.$file_name));

        Brand::insert([
            'brand_name'=>$request->brand_name,
            'brand_logo'=>$file_name,
        ]);
        return back()->with('add_brand', 'Brand Added Successfully');
    }


    function brand_delete($id){

        $brand = Brand::find($id);
        $brand_img = public_path('uploads/brand/'.$brand->brand_logo);
        unlink($brand_img);

        Brand::find($id)->delete();
        return back()->with('success','Brand Deleted Successfully');
    }

    function brand_edit($id){
        $brand = Brand::find($id);
        return view('admin.brand.brand_edit', [
            'brand'=>$brand,
        ]);
    }

    function brand_update(Request $request,  $id){
        if($request->brand_logo == null){
            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
            ]);
            return back()->with('brand_update', 'Brand Update Successful');
        }
        else{
            $brand = Brand::find($id);
            $current_brand_logo = public_path('uploads/brand/'.$brand->brand_logo);
            unlink($current_brand_logo);


            $logo = $request->brand_logo;
            $extension = $logo->extension();
            $file_name = Str::lower(str_replace(' ','-',$request->brand_name)).'.'.$extension;
            Image::make($logo)->save(public_path('uploads/brand/'.$file_name));

            Brand::find($id)->update([
                'brand_name'=>$request->brand_name,
                'brand_logo'=>$file_name,
            ]);
            return back()->with('brand_update', 'Brand Update Successful');

        }
    }














}
