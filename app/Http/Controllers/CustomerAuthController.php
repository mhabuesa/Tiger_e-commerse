<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerAuthController extends Controller
{
    function customer_login(){
        return view('frontend.customer.login');
    }
    function customer_register(){
        return view('frontend.customer.register');
    }
    function customer_store(Request $request){
        $request->validate([
            'fname'=>'required',
            'email'=>'required|unique:customers',
            'password'=>'required',
            'password_confirmation'=>'required',
        ]);

            Customer::insert([
            'fname'=>$request->fname,
            'lname'=>$request->lname,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'created_at'=>Carbon::now(),
        ]);

        return back()->with('success', 'Customer Registered Successfully');
    }

    function customer_logged(Request $request){
        $request->validate([
            'email'=>'required',
            'password'=>'required',
        ]);

        if(Customer::where('email', $request->email)->exists()){

            if(Auth::guard('customer')->attempt(['email'=>$request->email,  'password'=>$request->password])){
                return redirect()->route('index')->with('logged_in', 'You Are Logged In');
            }

            else{
                return back()->with('wrong', 'Invalid Password');
            }


        }
        else{
            return back()->with('exists', 'Email Does Not Exists');
        }
    }



}
