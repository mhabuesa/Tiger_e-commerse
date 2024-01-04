@extends('layouts.admin')
@section('style')
.del{
    width: 10px;
    padding-right:30px;
}
@endsection
@section('content')

<div class="row">
    <div class="col-lg-7">
        <div class="card">
            <div class="card-header">
                <h4>Inventory Of {{$product->product_name}}</h4>
                @if (session('inventory_delete'))
                <div class="alert alert-success">{{session('inventory_delete')}}</div>
            @endif
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Color</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($inventories as $key=> $inventory)

                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$inventory->rel_to_color->color_name}}</td>
                        <td>{{$inventory->rel_to_size->size}}</td>
                        <td>{{$inventory->quantity}}</td>
                        <td style="width:50px;">
                            <a href="{{route('inventory.delete',$inventory->id)}}" class="btn btn-danger"><i class="bi bi-trash"></i>Delete</a>
                        </td>
                    </tr>

                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-5">
        <div class="card">
            <div class="card-header">
                <h4>Product Inventory</h4>
                @if (session('inventory_store'))
                    <div class="alert alert-success">{{session('inventory_store')}}</div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{route('inventory.store',$product->id)}}" method="POST">
                    @csrf
                    <div class="mt-2">
                        <label for="" class="label-control">Product Name</label>
                        <input class="form-control" disabled type="text" value="{{$product->product_name}}">
                    </div>

                    <div class="mt-2">
                      <table class="table table-bordered">
                       <thead>
                        <tr>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Quantity</th>
                            <th style="width:50px">Action</th>
                        </tr>
                    </thead>



                       <tbody>
                        <tr id="row">
                            <td>
                                <select name="color_id[]" id="">
                                    <option>Select Color</option>
                                    @foreach ($colors as $color)
                                    <option value="{{$color->id}}">{{$color->color_name}}</option>
                                @endforeach
                                </select>
                            </td>
                                <td>
                                    <select name="size_id[]" id="">
                                        <option>Select Size</option>

                                        @foreach (App\Models\Size::where('category_id',$product->category_id)->get() as $size)
                                        <option value="{{$size->id}}">{{$size->size}}</option>
                                    @endforeach
                                    </select>
                                </td>
                            <td> <input style="width: 70px; padding:4px;" type="number" class="form-control" name="quantity[]"></td>
                            <td>
                                <button class="btn btn-danger del"
                                    id="DeleteRow"
                                    type="button">
                                    <i class="bi bi-trash px-0"></i>
                                </button>
                            </td>
                        </tr>
                       </tbody>

                            <tfoot id="newinput"></tfoot>

                      </table>
                      <button id="rowAdder" type="button" class="btn btn-dark float-right top-0">
                        <span class="bi bi-plus-square-dotted">
                        </span> ADD
                    </button>

                    </div>
                    <div class="mt-4">
                       <button class="btn btn-primary">Add Inventory</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection



@section('footer_script')
<script type="text/javascript">
    $("#rowAdder").click(function () {
        newRowAdd =
            '<tr id="row"><td>'+
                        '<select name="color_id[]" id="">'+
                        '<option>Select Color</option>'+
                        '@foreach ($colors as $color)'+
                        '<option value="{{$color->id}}">{{$color->color_name}}</option>'+
                        '@endforeach'+
                        '</select></td>'+
                        '<td><select name="size_id[]" id="">'+
                        '<option>Select Size</option>'+
                        '@foreach (App\Models\Size::where("category_id",$product->category_id)->get() as $size)'+
                        '<option value="{{$size->id}}">{{$size->size}}</option>'+
                        '@endforeach'+
                        '</select></td>'+
                        '<td><input style="width: 70px; padding:4px;" type="number" class="form-control" name="quantity[]"></td>'+
                        '<td><button class="btn btn-danger del"  id="DeleteRow" type="button">'+
                        '<i class="bi bi-trash"></i></button></td> </tr>';

        $('#newinput').append(newRowAdd);
    });
    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })
</script>


@endsection
