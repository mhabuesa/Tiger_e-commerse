@extends('layouts.admin')
@section('content')


<div class="row">
    <div class="col-lg-8">
       <div class="card">
        <div class="card-header">
            <h3>Category List</h3>
            @if (session('category_delete'))
                <div class="alert alert-success">{{session('category_delete')}}</div>
            @endif
            @if (session('soft_delete'))
                <div class="alert alert-success">{{session('soft_delete')}}</div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{route('checked.delete')}}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <td>
                           <div class="form-check">
                            <label class="form-check-label">
                                <input type="checkbox" class="check" name="all_check" id="chkSelectAll">
                                All Check
                            <i class="input-frame"></i>
                            </label>
                           </div>
                        </td>




                        <th>SL</th>
                        <th>Category Name</th>
                        <th>Category Icon</th>
                        <th>Action</th>
                    </tr>
                    @foreach ( $categories as $key=> $category )

                        <tr>

                            <td>
                               <div class="form-check">
                                <label class="form-check-label">
                                    <input type="checkbox"  class="form-check-input chkDel" name="category_id[]" value="{{$category->id}}">
                                <i class="input-frame"></i></label>
                               </div>
                            </td>

                            <td>{{$key+1}}</td>
                            <td>{{$category->category_name}}</td>
                            <td><img src="{{asset('uploads/category')}}/{{$category->icon}}" alt="$category->icon"></td>
                            <td>
                                <a href="{{route('category.soft.delete',$category->id)}}" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </a>
                                <a href="{{route('category.edit',$category->id)}}" class="btn btn-info btn-icon">
                                    <i data-feather="edit"></i>
                                </a>
                            </td>
                        </tr>

                    @endforeach
                </table>
                <button id="submit_prog" type="submit" class="btn btn-danger mt-2">
                    <i class="link-icon" data-feather="trash"></i>
                    Trash</button>


            </form>
        </div>
       </div>
    </div>




    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h3>Add New Category</h3>
                @if (session('add_category'))
                    <div class="alert alert-success">{{session('add_category')}}</div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{route('category.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label  class="form-label"> Category Name</label>
                        <input type="text" name="category_name" class="form-control" value="{{old('name')}}">
                        @error('category_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label  class="form-label"> Icon</label>
                        <input type="file" name="icon" class="form-control">
                        @error('icon')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>


                    <div class="mb-3">

                       <button  type="submit" class="btn btn-primary"> Add Category</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection


@section('footer_script')

<script>
    $("#chkSelectAll").on('click', function(){
    this.checked ? $(".chkDel").prop("checked",true) : $(".chkDel").prop("checked",false);
})
</script>

<script>
        $(document).ready(function() {

    var $submit = $("#submit_prog").hide(),
        $cbs = $('input[name="category_id[]"]').click(function() {
            $submit.toggle( $cbs.is(":checked") );
        });

});
</script>

<script>
        $(document).ready(function() {

    var $submit = $("#submit_prog").hide(),
        $cbs = $('input[name="all_check"]').click(function() {
            $submit.toggle( $cbs.is(":checked") );
        });

});
</script>
@endsection
