@extends('layouts.admin')

@section('content')
<div class="row">
    <div class="col-lg-4 ">
         <div class="card">
             <div class="card-body">
                        <h6 class="card-title">Update Profile</h6>
                        @if (session('info_update'))
                        <div class="alert alert-success"> {{session('info_update')}}</div>
                        @endif
                        <form class="forms-sample" action="{{route('user.info.update')}}" method="POST">
@csrf
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" class="form-control"  placeholder="Name"
                                name="name" value="{{Auth::user()->name}}">
                            </div>

                            <div class="form-group">
                                <label >Email</label>
                                <input type="email" class="form-control"
                                 placeholder="Email" name="email" value="{{Auth::user()->email}}">
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Update</button>

                        </form>
            </div>
        </div>
    </div>



    <div class="col-lg-4 ">
         <div class="card">
             <div class="card-body">
                        <h6 class="card-title">Password Update </h6>
                        @if(session('Password_updated'))
                                    <div class="alert alert-success">{{session('Password_updated')}}</div>
                                @endif

                        <form class="forms-sample" action="{{route('password.update')}}" method="POST">
@csrf
                            <div class="form-group">
                                <label>Current Password</label>
                                <input type="password" class="form-control"
                                name="current_password" >
                                @error('current_password')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                                @if(session('Password_wrong'))
                                    <strong class="text-danger">{{session('Password_wrong')}}</strong>
                                @endif
                            </div>

                            <div class="form-group">
                                <label >New Password</label>
                                <input type="password" class="form-control"
                                 name="password">
                                 @error('password')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label >Confirm Password</label>
                                <input type="password" class="form-control"
                                name="password_confirmation">
                                @error('password_confirmation')
                                    <strong class="text-danger">{{$message}}</strong>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary mr-2">Update</button>

                        </form>
            </div>
        </div>
    </div>




    <div class="col-lg-4 ">
         <div class="card">
             <div class="card-body">
            <h6 class="card-title">Profile Photo Update </h6>
            @if(session('photo_update'))
                        <div class="alert alert-success">{{session('photo_update')}}</div>
                    @endif

        <form class="forms-sample" action="{{route('photo.update')}}" method="POST" enctype="multipart/form-data">
@csrf
            <div class="form-group">
                <label>Current Password</label>
                    <input type="file" class="form-control"
                    name="photo" id="photo" >
                    @error('photo')
                        <strong class="text-danger">{{$message}}</strong>
                    @enderror
            </div>



            @if (Auth::user()->photo == null)
                <img class="mt-4" width="100px" height="100px" id="blah" src="{{ Avatar::create(Auth::user()->name)->toBase64() }}" />
            @else
                <img class="mt-4" width="100px" height="100px" id="blah" src="{{asset('uploads/user')}}/{{auth::user()->photo}}" />

            @endif
            <br>





                <button  type="submit" class=" mt-4 btn btn-primary mr-2">Update</button>

            </form>
            </div>
        </div>
    </div>
</div>
@endsection
