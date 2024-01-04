@extends('layouts.admin')
@section('content')


<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                <h3>User List</h3>
                @if (session('user_delete'))

                <div class="alert alert-success"> {{session('user_delete')}}</div>

                @endif
            </div>
            <div class="card-body">
                <table class="table table-bordered">

                    <tr>
                        <th>SL</th>
                        <th>Photo</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Action</th>
                    </tr>

                    @foreach ($users as $key=>  $user )

                    <tr>
                        <td>{{$key+1}}</td>
                        <td>
                            @if ($user->photo == null)
                            <img src="{{ Avatar::create($user->name)->toBase64() }}" />
                            @else
                                <img src="{{asset('uploads')}}/user/{{$user->photo}}" alt="">
                            @endif
                        </td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td>
                            <a href="{{route('user.delete', $user->id)}}" class="btn btn-danger btn-icon">
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
        <div class="card">
            <div class="card-header">
                <h3>Add New User</h3>
                @if (session('user_add'))
                    <div class="alert alert-success">{{session('user_add')}}</div>
                @endif
            </div>
            <div class="card-body">
                <form action="{{route('user.add')}}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label  class="form-label"> Name</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}">
                        @error('name')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label  class="form-label"> Email</label>
                        <input type="email" name="email" class="form-control"
                        value="{{old('email')}}">
                        @error('email')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label"> Password</label>
                        <input type="password" name="password" class="form-control">
                        @error('password')
                            <strong class="text-danger">{{$message}}</strong>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Confirm Password</label>
                        <input type="password" name="confirm_password" class="form-control">
                        @error('confirm_password')
                            <strong class="text-danger">{{$message}}</strong>
                            @enderror

                        @if (session('match'))

                            <strong class="text-danger">{{session('match')}}</strong>

                        @endif
                    </div>
                    <div class="mb-3">

                       <button type="submit" class="btn btn-primary"> Add User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>





@endsection
