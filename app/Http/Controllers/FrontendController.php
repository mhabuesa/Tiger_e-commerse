<?php

namespace App\Http\Controllers;

use App\Models\banner;
use App\Models\bigoffer;
use App\Models\Category;
use App\Models\inventory;
use App\Models\Offer1;
use App\Models\Offer2;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class FrontendController extends Controller
{
    function index(){
        $categories = Category::all();
        $banners = banner::all();
        $offer = Offer1::all();
        $offer2 = Offer2::all();
        $products = product::latest()->take(8)->get();
        $bigoffer = bigoffer::all();
        return view('frontend.index',[
            'categories'=>$categories,
            'banners'=>$banners,
            'offer'=>$offer,
            'offer2'=>$offer2,
            'products'=>$products,
            'bigoffer'=>$bigoffer,

        ]);
    }

    function banner(){
        $banners = banner::all();
        $categories = Category::all();
        return view('admin.banner.banner', [
            'categories'=>$categories,
            'banners'=>$banners,
        ]);
    }

    function banner_store(Request $request){
        $request->validate([
            'banner_name'=>'required',
            'link'=>'required',
            'banner_image'=>'required',
        ]);


        $image = $request->banner_image;
            $extension = $image->extension();
            $file_name = $request->banner_name.'-'.random_int(100, 500).'.'.$extension;
            Image::make($image)->save(public_path('uploads/banner/'.$file_name));

        banner::insert([

            'banner_name'=>$request->banner_name,
            'link'=>$request->link,
            'banner_image'=>$file_name,
            'created_at'=>Carbon::now(),
        ]);

        return back();
    }

    function banner_delete($id){


        $img = banner::find($id);
        $image = public_path('uploads/banner/'.$img->banner_image);
        unlink($image);

        banner::find($id)->delete();
        return back();

    }


    function offer(){
        $offer1 = Offer1::all();
        $offer2 = Offer2::all();
        return view('admin.offer.offer',[
            'offer1'=>$offer1,
            'offer2'=>$offer2,
        ]);
    }

    function offer1_store(Request $request, $id){
        $img = Offer1::find($id);

        if($request->image == ''){
            Offer1::find($id)->update([
                'title'=>$request->title,
                'after_discount'=>$request->after_discount,
                'price'=>$request->price,
                'date'=>$request->date,
                'created_at'=>Carbon::now(),
            ]);
            return back();
        }
        else{

            $image_location = public_path('uploads/offer/'.$img->image);
            unlink($image_location);

            $image = $request->image;
            $extension = $image->extension();
            $file_name = 'offer1'.'-'.random_int(100, 500).'.'.$extension;
            Image::make($image)->save(public_path('uploads/offer/'.$file_name));

            Offer1::find($id)->update([
                'title'=>$request->title,
                'after_discount'=>$request->after_discount,
                'price'=>$request->price,
                'date'=>$request->date,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
            return back();

        }

    }

    function offer2_store(Request $request, $id){
        $img = Offer2::find($id);

        if($request->image == ''){
            Offer2::find($id)->update([
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
            ]);
            return back();
        }
        else{
            $image_location = public_path('uploads/offer/'.$img->image);
            unlink($image_location);

            $image = $request->image;
            $extension = $image->extension();
            $file_name = 'offer2'.'-'.random_int(100, 500).'.'.$extension;
            Image::make($image)->save(public_path('uploads/offer/'.$file_name));

            Offer2::find($id)->update([
                'title'=>$request->title,
                'subtitle'=>$request->subtitle,
                'image'=>$file_name,
                'created_at'=>Carbon::now(),
            ]);
            return back();
        }


    }



    function big_offer(){
        $big_offer = bigoffer::all();
        return view('admin.offer.big_offer',[
            'big_offer'=>$big_offer,
        ]);
    }

    function big_offer_store(Request $request){
        $request->validate([
            'title'=>'required',
            'shape1'=>'required',
            'percentage'=>'required',
            'shape2'=>'required',
        ]);

        if($request->image == ''){
            bigoffer::find(1)->update([
                'title'=>$request->title,
                'shape1'=>$request->shape1,
                'percentage'=>$request->percentage,
                'shape2'=>$request->shape2,
            ]);
            return back();
        }
        else{
            $image = bigoffer::find(1)->image;
            $current_location = public_path('uploads/offer/'.$image);
            unlink($current_location);

            $img = $request->image;
            $extension = $img->extension();
            $file_name = 'big_offer'.'.'.$extension;
            Image::make($img)->save(public_path('uploads/offer/'.$file_name));


            bigoffer::find(1)->update([
                'title'=>$request->title,
                'shape1'=>$request->shape1,
                'percentage'=>$request->percentage,
                'shape2'=>$request->shape2,
                'image'=>$file_name,
            ]);
            return back();
        }
    }


    function deals(){
        return view('admin.deals.deals');
    }


    function single_product($slug){
        $product_id = product::where('slug',$slug)->first()->id;
        $product = product::find($product_id);
        $available_colors = inventory::where('product_id', $product_id)
        ->groupBy('color_id')
        ->selectRaw('sum(color_id) as sum, color_id')
        ->get();

        $available_sizes = inventory::where('product_id', $product_id)
        ->groupBy('size_id')
        ->selectRaw('sum(size_id) as sum, size_id')
        ->get();
        return view('frontend.single_product',[
            'product'=>$product,
            'available_colors'=>$available_colors,
            'available_sizes'=>$available_sizes,
        ]);
    }


    function getSize(Request $request){
        $str = '';
        $sizes = inventory::where('product_id',$request->product_id)->where('color_id', $request->color_id)->get();

        foreach($sizes as $size){
            if($size->rel_to_size->size_name == 'NA'){
                $str = '<li class="color1"><input class="size_id" checked id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
                <label for="size'.$size->size_id.'">'.$size->rel_to_size->size.'</label>
            </li>';

            }

            else{
                $str .= '<li class="color1"><input class="size_id" id="size'.$size->size_id.'" type="radio" name="size_id" value="'.$size->size_id.'">
                <label for="size'.$size->size_id.'">'.$size->rel_to_size->size.'</label>
            </li>';
            }
        }

        echo $str;
    }


    function getQuantity(Request $request){
        $str = '';
        $quantity = inventory::where('product_id', $request->product_id)->where('color_id', $request->color_id)->where('size_id', $request->size_id)->first()->quantity;

        if($quantity == 0){
            $str = '<strong id="quan" class="btn btn-danger">  Out Of Stock</strong>';
        }
        else{

            $str ='<strong id="quan" class="btn btn-success">'.$quantity.' In Stock</strong>';
        }

        echo $str;
    }




























}
