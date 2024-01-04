<div class="mini-cart">
    <button class="cart-toggle-btn"> <i class="fi flaticon-add-to-cart"></i>
        <span class="cart-count">{{App\Models\Cart::Where('customer_id',Auth::guard('customer')->id())->count()}}</span></button>
    <div class="mini-cart-content">
        <button class="mini-cart-close"><i class="ti-close"></i></button>
        <div class="mini-cart-items">

            @php
                $total = 0;
            @endphp

            @foreach ($carts as $cart )


            <div class="mini-cart-item clearfix">
                <div class="mini-cart-item-image">
                    <a href="product.html"><img
                            src="{{asset('uploads')}}/product/preview/{{App\Models\Product::find($cart->product_id)->preview}}"
                            alt></a>
                </div>
                <div class="mini-cart-item-des ">
                    <a href="product.html">{{ Str::substr($cart->rel_to_product->product_name, 0, 15). ' '. '...' }}</a>

                    <div class="d-flex justify-content-between">
                        <span class="mini-cart-item-price">&#2547; {{$cart->rel_to_product->after_discount}} x {{$cart->quantity}}</span>
                        <span class="mini-cart-item-price">&#2547; {{$cart->rel_to_product->after_discount*$cart->quantity}}</span>
                    </div>
                    <span class="mini-cart-item-quantity">
                        <a wire:click.prevent="delete({{$cart->id}})"><i class="ti-close"></i></a>
                    </span>
                </div>
            </div>
            @php
                $total += $cart->rel_to_product->after_discount*$cart->quantity;
            @endphp
            @endforeach

        </div>
        <div class="mini-cart-action clearfix">
            <span class="mini-checkout-price">Subtotal:
                <span>&#2547;{{$total}}</span></span>
            <div class="mini-btn">
                <a href="{{route('cart')}}" class="view-cart-btn">View Cart</a>
            </div>
        </div>
    </div>
</div>
