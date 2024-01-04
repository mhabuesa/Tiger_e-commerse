@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8 m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Add New Sub Category</h4>
            @if (session('sub_category'))
                <div class="alert alert-success">{{session('sub_category')}}</div>
            @endif
            </div>
            <div class="card-body">
                <form action="{{route('sub.category.update',$subcategory->id)}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Category Name</label>
                        <select name="category" class="form-control">
                            <option value=""> Select Category</option>
                            @foreach ($categories as $category )
                            <option {{$subcategory->category_id == $category->id?'selected':''}} value="{{$category->id}}">{{$category->category_name}}</option>

                            @endforeach
                        </select>
                        @error('category')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Subcategory Name</label>
                        <input value="{{$subcategory->sub_category}}" type="text" name="sub_category" class="form-control">

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
