<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Faker\Extension\Extension;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class CustomerController extends Controller
{
    function customer_profile(){
        return view('frontend.customer.profile');
    }
    //Customer Logout
    function customer_logout(){
        Auth::guard('customer')->logout();
        return redirect()->route('index')->with('logout', 'You Are Logged out');
    }

    //Form Validation
    function customer_update(Request $request){
        $request->validate([
            'fname'=>'required',
            'lname'=>'required',
            'phone'=>'required',
        ]);

        //If password Field is empty

        if($request->password == ''){


            //If Photo Field is empty

            if($request->photo == ''){

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname'=>$request->fname,
                    'lname'=>$request->lname,
                    'phone'=>$request->phone,
                    'zip'=>$request->zip,
                    'address'=>$request->address,
                ]);

            }
            else{

                //If photo Field is filled but Before, it was empty

                if(Auth::guard('customer')->user()->photo == ''){
                    $photo = $request->photo;
                    $extension = $photo->extension();
                    $file_name = 'customer'. '_'. Auth::guard('customer')->id().'.'.$extension;

                    Image::make($photo)->resize(400, 400)->save(public_path('uploads/customer/'.$file_name));

                    Customer::find(Auth::guard('customer')->id())->update([
                        'fname'=>$request->fname,
                        'lname'=>$request->lname,
                        'phone'=>$request->phone,
                        'zip'=>$request->zip,
                        'address'=>$request->address,
                        'photo'=>$file_name,
                    ]);
                }
                else{

                    //photo Field is filled and Before, it was used

                    $old_photo = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo) ;
                    unlink($old_photo);

                    $photo = $request->photo;
                    $extension = $photo->extension();
                    $file_name = 'customer'. '_'. Auth::guard('customer')->id().'.'.$extension;

                    Image::make($photo)->resize(400, 400)->save(public_path('uploads/customer/'.$file_name));

                    Customer::find(Auth::guard('customer')->id())->update([
                        'fname'=>$request->fname,
                        'lname'=>$request->lname,
                        'phone'=>$request->phone,
                        'zip'=>$request->zip,
                        'address'=>$request->address,
                        'photo'=>$file_name,
                    ]);
                }

            }

        }

        else{

            //input a new password
            //If Photo Field is empty

            if($request->photo == ''){

                Customer::find(Auth::guard('customer')->id())->update([
                    'fname'=>$request->fname,
                    'lname'=>$request->lname,
                    'phone'=>$request->phone,
                    'zip'=>$request->zip,
                    'address'=>$request->address,
                    'password'=>bcrypt($request->password),
                ]);

            }
            else{
                //input a new password
                //photo Field is filled but Before, it was empty

                if(Auth::guard('customer')->user()->photo == ''){
                    $photo = $request->photo;
                    $extension = $photo->extension();
                    $file_name = 'customer'. '_'. Auth::guard('customer')->id().'.'.$extension;

                    Image::make($photo)->resize(400, 400)->save(public_path('uploads/customer/'.$file_name));

                    Customer::find(Auth::guard('customer')->id())->update([
                        'fname'=>$request->fname,
                        'lname'=>$request->lname,
                        'phone'=>$request->phone,
                        'zip'=>$request->zip,
                        'address'=>$request->address,
                        'password'=>bcrypt($request->password),
                        'photo'=>$file_name,
                    ]);
                }
                else{

                    //photo Field is filled and Before, it was used

                    $old_photo = public_path('uploads/customer/'.Auth::guard('customer')->user()->photo) ;
                    unlink($old_photo);

                    $photo = $request->photo;
                    $extension = $photo->extension();
                    $file_name = 'customer'. '_'. Auth::guard('customer')->id().'.'.$extension;

                    Image::make($photo)->resize(400, 400)->save(public_path('uploads/customer/'.$file_name));

                    Customer::find(Auth::guard('customer')->id())->update([
                        'fname'=>$request->fname,
                        'lname'=>$request->lname,
                        'phone'=>$request->phone,
                        'zip'=>$request->zip,
                        'address'=>$request->address,
                        'password'=>bcrypt($request->password),
                        'photo'=>$file_name,
                    ]);
                }



            }


        }

        return back()->with('update', 'Account Updated Successfully!');
    }
}
