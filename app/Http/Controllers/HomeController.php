<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
   function dashboard(){
    return view('dashboard');
   }

   function user_list(){
    $users = User::where('id', '!=', Auth::id())->get();
    return view('admin.user.user_list', compact('users'));
   }
   function user_delete($user_id){
    User::find($user_id)->delete();
    return back()->with('user_delete', 'User Delete Successfully');

   }

   function user_add(Request $request){
$request->validate([
        'name'=>'required',
        'email'=>'required',
        'password'=>'required',
        'password'=>Password::min(8)
        ->letters()
        ->mixedCase()
        ->numbers()
        ->symbols(),
        'confirm_password'=>'required',
    ]);

    if($request->password != $request->confirm_password){

        return back()->with('match', 'Password And Confirm Password Does Not Match');

    }
User::insert([
    'name'=>$request->name,
    'email'=>$request->email,
    'password'=>bcrypt($request->password),
]);
return back()->with('user_add', 'User Add Successfully');

   }






   function test(){
    return view('admin.test');
   }



}
