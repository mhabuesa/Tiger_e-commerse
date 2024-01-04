@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
       <div class="card">
        <div class="card-header">
            <h3>Category List</h3>
            @if (session('restore'))
                <div class="alert alert-success">{{session('restore')}}</div>
            @endif
            @if (session('category_per_delete'))
                <div class="alert alert-success">{{session('category_per_delete')}}</div>
            @endif
        </div>
        <div class="card-body">
            <form action="{{route('checked.restore')}}" method="POST">
                @csrf
                <table class="table table-bordered">
                    <tr>
                        <td>
                            <div class="form-check">
                             <label class="form-check-label">
                                 <input type="checkbox" class=" check" name="all_check" id="chkSelectAll">
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
                    @forelse ( $categories as $key=> $category )

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
                                <a href="{{route('category.restore',$category->id)}}" class="btn btn-success btn-icon">
                                    <i data-feather="rotate-cw"></i>
                                </a>
                                <a href="{{route('category.delete',$category->id)}}" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>

                        @empty
                        <tr>
                            <td colspan="4" class="text-center" ><h4>No Trash Category Found</h4></td>
                        </tr>

                    @endforelse
                </table>




                {{-- <div class=" mt-3 mb-0 ">
                    <input title="Restore" type="radio" checked class="btn-check " name="select" value="restore" id="success-outlined" autocomplete="off">
                    <label class="btn btn-outline-success" for="success-outlined">Restore</label>

                    <input name="select" value="delete" title="Permanent Delete"  type="radio" class="btn-check ml-3" name="options-outlined" id="danger-outlined" autocomplete="off">
                    <label class="btn btn-outline-danger" for="danger-outlined">Permanent Delete</label>
                </div> --}}








                    <button   for="success-outlined"  autocomplete="off" name="select" value="restore"  type="submit" id="submit_prog" class="btn btn-outline-success mt-2"> Restore</button>
                    <button  for="danger-outlined" autocomplete="off" name="select" value="delete"  type="submit" id="submit_progg" class="btn btn-outline-danger mt-2"> Delete</button>
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


{{-- Button nonvisible --}}
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

<script>
    $(document).ready(function() {

var $submit = $("#submit_progg").hide(),
    $cbs = $('input[name="category_id[]"]').click(function() {
        $submit.toggle( $cbs.is(":checked") );
    });

});
</script>

<script>
    $(document).ready(function() {

var $submit = $("#submit_progg").hide(),
    $cbs = $('input[name="all_check"]').click(function() {
        $submit.toggle( $cbs.is(":checked") );
    });

});
</script>
@endsection
