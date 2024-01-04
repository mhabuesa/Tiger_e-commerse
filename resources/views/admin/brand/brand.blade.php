@extends('layouts.admin')
@section('content')
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h4>Brand List</h4>
                @if(session('success'))
                <div class="alert alert-success text-capitalize">{{session('success')}}</div>
                @endif
            </div>
            <div class="card-body">
                <table class="table table-bordered">
                    <tr>
                        <th>SL</th>
                        <th>Brand Name</th>
                        <th>Brand Logo</th>
                        <th>Action</th>
                    </tr>
                    @foreach ($brands as $key=> $brand )
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$brand->brand_name}}</td>
                            <td>
                                <img src="{{asset('uploads/brand')}}/{{$brand->brand_logo}}" title="{{$brand->brand_logo}}">
                            </td>
                            <td>

                                <a href="{{route('brand.edit',$brand->id)}}" class="btn btn-info btn-icon">
                                    <i data-feather="edit"></i>
                                </a>
                                <a href="{{route('brand.delete',$brand->id)}}" class="btn btn-danger btn-icon">
                                    <i data-feather="trash"></i>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </table>
            </div>
        </div>
    </div>
    <div class="col-lg-4">
       <form action="{{route('brand.store')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="card">
                <div class="card-header">
                    <h3>Add Brand</h3>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <label for="" class="form-label"> Brand Name</label>
                        <input class="form-control" type="text" name="brand_name" value="{{old('brand_name')}}">
                        @error('brand_name')
                            <strong class="text-danger text-capitalize">{{$message}}</strong>
                        @enderror
                        @if(session('add_brand'))
                        <strong class="text-success text-capitalize">{{session('add_brand')}}</strong>
                        @endif

                    </div>
                    <div class="mb-4">
                        <label class="form-label"> Brand Logo</label>
                        <input class="form-control" type="file" name="brand_logo">
                        @error('brand_logo')
                            <strong class="text-danger text-capitalize">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3 mt-3">
                       <button type="submit" class="btn btn-primary"> Add Brand</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
