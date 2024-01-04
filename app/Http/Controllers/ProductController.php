<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Gallery;
use App\Models\product;
use App\Models\Subcategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class ProductController extends Controller
{
   function add_product(){
    $categories = Category::all();
    $subcategories = Subcategory::all();
    $brands = Brand::all();
    return view('admin.product.add_product',[
        'categories'=>$categories,
        'subcategories'=>$subcategories,
        'brands'=>$brands,

    ]);
   }

   function getSubcategory(Request $request){
    $str = '<option value=""> Select Sub Category</option>';
    $subcategories = Subcategory::where('category_id', $request->category_id)->get();
    foreach($subcategories as $subcategory){
       $str .='<option value="'.$subcategory->id.'">'.$subcategory->sub_category.'</option>';
     }

     echo $str;
   }

   function product_store(Request $request){

    $request->validate([
        'category_id'=>'required',
        'subcategory_id'=>'required',
    ]);

    $remove = array("@", "!", "#", "(", ")", "*", "/", '"');
    $slug_remove = array("@", "!", "#", "(", ")", "*", "/", '"',' ');
    $slug = Str::lower(str_replace($slug_remove , '-',$request->product_name)).random_int(50000, 60000);

    $preview = $request->preview;
    $extension = $preview->extension();
    $file_name = Str::lower(str_replace($remove , '-',$request->product_name)).random_int(5000, 6000).'.'.$extension;
    Image::make($preview)->save(public_path('uploads/product/preview/'.$file_name));

   $product_id = Product::insertGetId([
        'category_id'=>$request->category_id,
        'subcategory_id'=>$request->subcategory_id,
        'brand_id'=>$request->brand_id,
        'product_name'=>$request->product_name,
        'price'=>$request->price,
        'discount'=>$request->discount,
        'after_discount'=>$request->price - $request->price*$request->discount/100,
        'tags'=>implode(',',$request->tags),
        'short_desp'=>$request->short_desp,
        'long_desp'=>$request->long_desp,
        'addi_info'=>$request->addi_info,
        'preview'=>$file_name,
        'slug'=>$slug,
        'created_at'=>Carbon::now(),
    ]);

    $galleries = $request->gallery;

    foreach($galleries as $gallery){
        $remove = array("@", "!", "#", "(", ")", "*", "/", '"');
        $extension = $gallery->extension();
        $file_name = Str::lower(str_replace($remove, '-',$request->product_name)).random_int(5000, 6000).'.'.$extension;
        Image::make($gallery)->save(public_path('uploads/product/gallery/'.$file_name));

        Gallery::insert([
            'product_id'=>$product_id,
            'gallery'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

    }



    return back()->with('success', 'New Product Added!');


}

function product_list(){
    $products = product::all();
    return view('admin.product.product_list',[
        'products'=>$products,
    ]);

}


function getstatus(Request $request){
   product::find($request->product_id)->update([
    'status'=>$request->status,
   ]);

}


function product_details($id){
    $product = product::find($id);
    $categories = Category::all();
    $brands = Brand::all();
    return view('admin.product.product_details',[
        'categories'=>$categories,
        'brands'=>$brands,
        'product'=>$product,
    ]);
}

function product_edit(Request $request, $id){
    $request->validate([
        'category_id'=>'required',
        'subcategory_id'=>'required',
        'brand_id'=>'required',
        'product_name'=>'required',
        'price'=>'required',
        'short_desp'=>'required',
    ]);

    product::find($id)->update([
        'category_id'=>$request->category_id,
        'subcategory_id'=>$request->subcategory_id,
        'brand_id'=>$request->brand_id,
        'product_name'=>$request->product_name,
        'price'=>$request->price,
        'discount'=>$request->discount,
        'after_discount'=>$request->price - $request->price*$request->discount/100,
        'tags'=>implode(',',$request->tags),
        'short_desp'=>$request->short_desp,
        'long_desp'=>$request->long_desp,
        'addi_info'=>$request->addi_info,
    ]);



    if($request->preview != null){
        $product = product::find($id);
        $remove = array("@", "!", "#", "(", ")", "*", "/", '"');
        $preview = $request->preview;
        $extension = $preview->extension();
        $file_name = Str::lower(str_replace($remove , '-',$request->product_name)).random_int(5000, 6000).'.'.$extension;



        $current_img = public_path('uploads/product/preview/'.$product->preview);
        unlink($current_img);
        Image::make($preview)->save(public_path('uploads/product/preview/'.$file_name));

        product::find($id)->update([
            'preview'=>$file_name,
        ]);
    }

    if($request->gallery != null){
        $galleries = $request->gallery;

    foreach($galleries as $gallery){
        $remove = array("@", "!", "#", "(", ")", "*", "/", '"');
        $extension = $gallery->extension();
        $file_name = Str::lower(str_replace($remove, '-',$request->product_name)).random_int(5000, 6000).'.'.$extension;
        Image::make($gallery)->save(public_path('uploads/product/gallery/'.$file_name));

        Gallery::insert([
            'product_id'=>$id,
            'gallery'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

    }

    }

return back()->with('product_update','Product Updated Successfully');



}


function product_delete($id){
    $product = product::find($id);
    $preview_img = public_path('uploads/product/preview/'.$product->preview);
    unlink($preview_img);

    $galleries = Gallery::where('product_id', $id)->get();

    foreach ($galleries as $gallery){
        $gallery_img = public_path('uploads/product/gallery/'.$gallery->gallery);
        unlink($gallery_img);
    }

    product::find($id)->delete();
    Gallery::Where('product_id',$id)->delete();
    return back()->with('product_delete','Product Delete Successfully');
}












}
