<?php

namespace App\Livewire;

use App\Models\Cart as ModelsCart;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Cart extends Component
{

    public function delete($id){
        ModelsCart::find($id)->delete();
    }


    public function render()
    {
        $carts = ModelsCart::where('customer_id', Auth::guard('customer')->id())->get();

        return view('livewire.cart',[
            'carts'=>$carts,
        ]);
    }
}
