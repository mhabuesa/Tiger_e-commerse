@extends('layouts.admin')

@section('content')

<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>Update Category</h3>
                @if (session('cat_update'))
                    <div class="alert alert-success">{{session('cat_update')}}</div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{route('category.update', $category->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mb-3">
                        <label  class="form-label"> Category Name</label>
                        <input type="text" name="category_name" class="form-control" value="{{$category->category_name}}">
                        @error('category_name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label  class="form-label"> Icon</label>
                        <input type="file" id="photo" name="icon" class="form-control">
                        @error('icon')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror

                        <div>
                            <img class="mt-4" id="blah" width="70px" height="70px" src="{{asset('uploads/category')}}/{{$category->icon}}" alt="">
                        </div>
                    </div>


                    <div class="mb-3">

                       <button type="submit" class="btn btn-primary"> Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
