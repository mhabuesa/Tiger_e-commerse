@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card bg-light">
                <div class="card-header">
                    <h4>Color List</h4>
                    @if (session('color_delete'))
                        <div class="alert alert-success">{{session('color_delete')}}</div>
                    @endif
                </div>
                <div class="card-body">
                    <table class="table table-bordered">

                        <tr>
                            <td>SL</td>
                            <td>Color Name</td>
                            <td>Color Code</td>
                            <td>Action</td>
                        </tr>

                    @foreach (App\Models\Color::all() as $sl=> $color )
                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>{{$color->color_name}}</td>
                            <td>
                                <i style="background: {{$color->color_code == null?'':$color->color_code}}; width:50px; height:30px; display:inline-block;
                                color:{{$color->color_code == null?'':'transparent'}}">{{$color->color_code == null?$color->color_name:'color'}}</i>
                            </td>
                            <td><a class="btn btn-danger" href="{{route('color.delete', $color->id)}}">Delete</a></td>
                        </tr>
                    @endforeach
                    </table>
                </div>
            </div>



            <div class="card mt-3">
                <div class="card-header">
                    <h4>Size List</h4>
                    @if (session('size_delete'))
                        <div class="alert alert-success">{{session('size_delete')}}</div>
                    @endif
                </div>
                <div class="card-body">
                    <div class="row">
                        @foreach ($categories as $category)
                        <div class="col-lg-6 mt-3">
                        <h5>{{$category->category_name}}</h5>

                        <table class="table table-bordered">
                            <tr>
                                <th>SL</th>
                                <th>Size</th>
                                <th>Action</th>
                            </tr>
                           @forelse (App\Models\Size::Where('category_id', $category->id)->get() as $key=> $size)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$size->size}}</td>
                                <td>
                                    <a href="{{route('size.delete', $size->id)}}" class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                            @empty
                            <tr class="text-center" ><th colspan="3" ><strong>Size Not Found</strong></th></tr>

                           @endforelse
                        </table>

                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>


        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Color</h4>
                    @if (session('color_success'))
                        <div class="alert alert-success"> {{ session('color_success') }}</div>
                    @endif()
                </div>
                <div class="card-body">
                    <form action="{{ route('color.store') }}" method="Post">
                        @csrf
                        <div class="mt-2">
                            <label for="" class="form-label">Color Name</label>
                            <input type="text" name="color_name" class="form-control">
                            @error('color_name')
                                <strong class="text-danger">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="mt-2">
                            <label for="" class="form-label">Color Code</label>
                            <input type="text" name="color_code" class="form-control">

                        </div>
                        <div class="mt-4">
                            <button class="btn btn-primary">Add Color</button>
                        </div>
                    </form>
                </div>
            </div>



            <div class="card mt-3 ">
                <div class="card-header">
                    <h4>Add Size</h4>
                    @if (session('size'))
                        <div class="alert alert-success"> {{ session('size') }}</div>
                    @endif()
                </div>
                <div class="card-body">


                    <form action="{{ route('size.store') }}" method="Post">
                        @csrf

                        <div class="mt-2">
                            <label for="" class="form-label">Category</label>
                            <select name="category_id" class="from-control">
                                <option value="">Select Category</option>
                                @foreach ($categories as $category)
                                <option value="{{$category->id}}">{{$category->category_name}}</option>

                                @endforeach
                            </select>
                        </div>
                        <div class="mt-3">
                            <label for="" class="form-label mb-0">Size Name</label>
                            <div id="row">
                                <div class="input-group">
                                    <input type="text" class="form-control m-input" name="size[]">
                                    <div class="input-group-prepend">
                                        <button class="btn btn-danger"
                                                id="DeleteRow"
                                                type="button">
                                            <i class="bi bi-trash"></i>
                                            Delete
                                        </button>
                                    </div>

                                </div>
                            </div>

                            <div id="newinput"></div>
                            <button id="rowAdder" type="button" class="btn btn-dark float-right mt-1">
                                <span class="bi bi-plus-square-dotted">
                                </span> ADD
                            </button>
                        </div>

                            <div class="mt-4">
                                <button class="btn btn-primary">Add Size</button>
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
            '<div id="row"> <div class="input-group mt-2">' +
            '<input type="text" class="form-control m-input"  name="size[]">'+
            '<div class="input-group-prepend">' +
            '<button class="btn btn-danger" id="DeleteRow" type="button">' +
            '<i class="bi bi-trash"></i> Delete</button> </div></div>';

        $('#newinput').append(newRowAdd);
    });
    $("body").on("click", "#DeleteRow", function () {
        $(this).parents("#row").remove();
    })
</script>


@endsection
