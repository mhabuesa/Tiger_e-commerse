<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class CategoryController extends Controller
{
    function add_category(){
        $categories = Category::all();
        return view('admin.category.add_category', compact('categories'));
       }
    function category_store(Request $request ){
        $request->validate([
            'category_name'=>'required|unique:categories',
            'icon'=>'required','image',

        ]);


        $icon = $request->icon;
        $extension = $icon->extension();
        $file_name = str::lower(str_replace(' ', '-',$request->category_name)).'-'.random_int(5000, 6000). '.'.$extension;
        Image::make($icon)->save(public_path('uploads/category/'.$file_name));


        Category::insert([
            'category_name'=>$request->category_name,
            'icon'=>$file_name,

        ]);
        return back()->with('add_category', 'Category Added Successfully') ;

    }

    function category_soft_delete($category_id){
        Category::find($category_id)->delete();
        return back()->with('category_delete', 'Category Move to Trash') ;

       }



       function category_trash(){
           $categories = Category::onlyTrashed()->get();
           return view('admin.category.trash_category',[
            'categories'=>$categories,
           ]);
        }




        function category_restore($id){
            Category::onlyTrashed()->find($id)->restore();
            return back()->with('restore', 'Category Move to Restore') ;
        }



        function category_delete($id){
            $cat = Category::onlyTrashed()->find($id);
            $cat_img = public_path('uploads/category/'.$cat->icon);
            unlink($cat_img);

        Category::onlyTrashed()->find($id)->forceDelete();

        Subcategory::where('category_id',$id)->update([
            'category_id'=>1,
        ]);
        return back()->with('category_per_delete', 'Category Permanent Delete') ;

        }



        function category_edit($id){
            $category = Category::find($id);
            return view('admin.category.edit_category',[
                'category'=>$category,
            ]);

           }


        function category_update(Request $request , $id){
            $request->validate([
                'category_name'=>'required',
            ]);

            if($request->icon == ''){
                Category::find($id)->update([
                    'category_name'=>$request->category_name,
                ]);
                return back()->with('cat_update', 'Category Updated Successfully');

            }
            else{
                $cat = Category::find($id);
                $cat_img = public_path('uploads/category/'.$cat->icon);
                unlink($cat_img);

                $icon = $request->icon;
                $extension = $icon->extension();
                $file_name = str::lower(str_replace(' ', '-',$request->category_name)).'-'.random_int(5000, 6000). '.'.$extension;
                Image::make($icon)->save(public_path('uploads/category/'.$file_name));

                Category::find($id)->update([
                    'category_name'=>$request->category_name,
                    'icon'=>$file_name ,
                ]);

                return back()->with('cat_update', 'Category Updated Successfully');





            }
        }


        function checked_delete(Request $request){
            foreach($request->category_id as $category){
                Category::find($category)->delete();
            }
            return back()->with('soft_delete', 'Category Move To Trash');
        }



        function checked_restore(Request $request){

            if($request->select == 'restore'){
                foreach($request->category_id as $category){
                    Category::onlyTrashed()->find($category)->restore();
                }

                return back()->with('restore', 'Category Move to Restore');
            }
            else{
                foreach($request->category_id as $category){
                  Category::onlyTrashed()->find($category)->forceDelete();
                }
                return back()->with('category_per_delete', 'Category Permanent Delete') ;
            }

        }


        // function permanent_delete(Request $request){
        //     print_r($request->category_id);





        // }




}
