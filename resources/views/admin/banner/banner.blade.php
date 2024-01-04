@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h4>Banner Liist</h4>
                </div>
                <div class="card-body">
                    <table class="table table-striped ">
                        <tr class="thead-dark">
                            <th>SL</th>
                            <th>Banner</th>
                            <th>Link</th>
                            <th>Image</th>
                            <th>action</th>
                        </tr>
                        @foreach ($banners as $sl=> $banner )


                        <tr>
                            <td>{{$sl+1}}</td>
                            <td>{{$banner->banner_name}}</td>
                            <td>{{$banner->link}}</td>
                            <td>
                                <img src="{{asset('uploads/banner')}}/{{$banner->banner_image}}" alt="">
                            </td>
                            <td>
                                <a href="{{route('banner.delete',$banner->id)}}" class="btn btn-danger">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h4>Add Banner </h4>
                </div>
                <div class="card-body">
                    <form action="{{route('banner.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="mt-2">
                        <label class="form-label">Banner Name</label>
                        <input type="text" class="form-control" name="banner_name">
                        @error('banner_name')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Link</label>
                       <select name="link">
                        <option value="">Select Category</option>
                        @foreach ($categories as $sl=> $category)
                        <option value="{{Str::lower($category->category_name)}}">{{$category->category_name}}</option>
                        @endforeach
                       </select>
                       @error('link')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <label class="form-label">Banner Image</label>
                        <input type="file" class="form-control" name="banner_image">
                        @error('banner_image')
                            <div class="text-danger">{{$message}}</div>
                        @enderror
                    </div>

                    <div class="mt-2">
                        <button class="btn btn-primary">Add Banner</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
