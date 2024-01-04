@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Subcategory List</h3>
            </div>
            <div class="card-body">
                <div class="row">
                    @foreach ($categories as $category )


                    <div class="col-lg-6 my-2">
                        <div class="card">
                            <div class="card-header">

                                <h4> <img title="Icon" class="mr-0" width="20" src="{{asset('uploads/category')}}/{{$category->icon}}" alt=""> {{$category->category_name}}</h4>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <tr>
                                        <th>Sub Category</th>
                                        <th>Action</th>
                                    </tr>

                                    @forelse (App\Models\Subcategory::where('category_id',$category->id)->get() as $subcategory )


                                    <tr>
                                        <td>{{$subcategory->sub_category}}</td>
                                        <td>

                                            <a href="{{route('sub.category.edit',$subcategory->id)}}" class="btn btn-info btn-icon">
                                                <i data-feather="edit"></i>
                                            </a>
                                            <a  class="btn btn-danger btn-icon del_btn" data-link="{{route('sub.category.delete',$subcategory->id)}}">
                                                <i data-feather="trash"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    @empty
                                    <tr class="text-center"><th colspan="2">Sub Category Not Found</th></tr>
                                    @endforelse
                                </table>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>


    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h4>Add New Sub Category</h4>
            @if (session('sub_category'))
                <div class="alert alert-success">{{session('sub_category')}}</div>
            @endif
            @if (session('exist'))
                <div class="alert alert-warning">{{session('exist')}}</div>
            @endif
            </div>
            <div class="card-body">
                <form action="{{route('sub.category.store')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <select name="category" class="form-control">
                            <option value=""> Select Category</option>
                            @foreach ($categories as $category )
                            <option value="{{$category->id}}">{{$category->category_name}}</option>

                            @endforeach
                        </select>
                        @error('category')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subcategory Name</label>
                        <input type="text" name="sub_category" class="form-control">

                    @error('sub_category')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
                    </div>
                    <button class="btn btn-primary ">Add Sub Category</button>
                </form>
            </div>
        </div>
    </div>
</div>


@endsection

@section('footer_script')

<script>
$('.del_btn').click(function(){
        var link = $(this).attr('data-link');

        const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
})

swalWithBootstrapButtons.fire({
  title: 'Are you sure?',
  text: "You won't be able to revert this!",
  icon: 'warning',
  showCancelButton: true,
  confirmButtonText: 'Yes, delete it!',
  cancelButtonText: 'No, cancel!',
  reverseButtons: true
}).then((result) => {
  if (result.isConfirmed) {
    window.location.href = link;
  } else if (
    /* Read more about handling dismissals below */
    result.dismiss === Swal.DismissReason.cancel
  ) {
    swalWithBootstrapButtons.fire(
      'Cancelled',
      'Your imaginary file is safe :)',
      'error'
    )
  }
})
})
</script>



@if (session('success'))
    <script>
         Swal.fire(
            'Deleted!',
            '{{session('success')}}',
            'success'
            )
    </script>
@endif
@endsection
