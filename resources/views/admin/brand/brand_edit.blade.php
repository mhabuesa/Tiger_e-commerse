@extends('layouts.admin')
@section('content')
<div class="row"></div>
    <div class="col-lg-6 m-auto">
        <div class="card">
            <div class="card-header">
                <h4>Brand Edit</h4>
                @if (session('brand_update'))
                    <div class="alert alert-success">{{session('brand_update')}}</div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{route('brand.update', $brand->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2 mb-3">
                        <label for="" class="form-label">Brand Name</label>
                        <input type="text" class="form-control" name="brand_name" value="{{$brand->brand_name}}">
                    </div>
                    <div class="mt-2 mb-3">
                        <label for="" class="form-label">Brand Logo</label>
                        <input type="file" class="form-control" name="brand_logo" value="">
                    </div>
                    <div class="mt-2 mb-3">
                        <label for="" class="form-label">Current Logo</label> <br>
                       <img width="100" src="{{asset('uploads/brand')}}/{{$brand->brand_logo}}" alt="">
                    </div>
                    <div class="mt-2 d-flex justify-content-between mb-3">
                       <button class="btn btn-primary">Update Brand</button>
                       <a href="{{route('brand')}}" class="btn btn-info">Back to Brand List</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
