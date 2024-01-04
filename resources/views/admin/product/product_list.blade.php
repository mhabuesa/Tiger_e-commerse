@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h4>Product List</h4>
                <a href="{{route('add.product')}}" class="btn btn-primary  "> <i data-feather="plus"></i> Add Product</a>
            </div>
            @if (session('product_delete'))
                 <div class="alert alert-success">{{session('product_delete')}} </div>
             @endif
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Product</th>
                        <th>Price</th>
                        <th>Discount</th>
                        <th>After Discount</th>
                        <th>Preview</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($products as $sl=> $product)

                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->price}}</td>
                            <td>{{$product->discount == null?'0':$product->discount}}</td>
                            <td>{{$product->after_discount}}</td>
                            <td>
                                <img width="30" src="{{asset('uploads/product/preview')}}/{{$product->preview}}" title="{{$product->product_name}} Image" alt="">
                            </td>
                            <td>
                               <input type="checkbox" {{$product->status == 1?'checked':''}} data-id="{{$product->id}}" class="status" data-toggle="toggle" value="{{$product->status}}">
                            </td>
                            <td>
                                <a href="{{route('inventory', $product->id)}}" class="btn btn-info btn-icon">
                                    <i data-feather="database"></i>
                                </a>
                                <a href="{{route('product.details', $product->id)}}" class="btn btn-success btn-icon">
                                    <i data-feather="eye"></i>
                                </a>


                                <a href="{{route('product.delete', $product->id)}}" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>

</div>

@endsection

@section('footer_script')
<script>
    $('.status').change(function(){
        if($(this).val() !=1){
            $(this).attr('value', 1)
        }
        else{
            $(this).attr('value', 0)
        }

        var product_id =  $(this).attr('data-id');
        var status = $(this).val();

        $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url:'/getstatus',
            type:'POST',
            data:{'product_id':product_id, 'status':status },
            success: function (data){

            }
        });
    })
</script>
@endsection
