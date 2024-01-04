<?php

namespace App\Http\Controllers;

use App\Models\Subscribe;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SubscribeController extends Controller
{
    function subscribe(){
        $subscribes = Subscribe::all();
        return view('admin.subscribe.subscribe', [
            'subscribes'=>$subscribes,
        ]);
    }


    function subscribe_store( Request $request){
        $request->validate([
            'email'=>'required'
        ]);

        Subscribe::insert([
            'email'=>$request->email,
            'created_at'=>Carbon::now(),
        ]);
        return back();
    }


}
