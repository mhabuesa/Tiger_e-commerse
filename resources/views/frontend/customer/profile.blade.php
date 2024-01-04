@extends('frontend.master')
@section('content')
    <!-- start wpo-page-title -->
    <section class="wpo-page-title">
        <h2 class="d-none">Hide</h2>
        <div class="container">
            <div class="row">
                <div class="col col-xs-12">
                    <div class="wpo-breadcumb-wrap">
                        <ol class="wpo-breadcumb-wrap">
                            <li><a href="index.html">Home</a></li>
                            <li><a href="product.html">Product</a></li>
                            <li>Product Single</li>
                        </ol>
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end page-title -->

    <div class="container">
        <div class="row py-5">



            <div class="col-lg-3">
                <div class="card pt-2 text-center" style="width: 18rem;">

                    @if (Auth::guard('customer')->user()->photo == null)
                        <img width="75" class="m-auto" src="{{ Avatar::create(Auth::guard('customer')->user()->fname.Auth::guard('customer')->user()->lname)->toBase64() }}" />
                    @else
                        <img width="75" class="m-auto" src="{{asset('uploads')}}/customer/{{Auth::guard('customer')->user()->photo}}" alt="">
                    @endif

                    <div class="card-body">
                        <h5 class="card-title ">{{Auth::guard('customer')->user()->fname. ' '.Auth::guard('customer')->user()->lname }}</h5>

                    </div>
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item py-3 bg-light"><a href="#" class="text-dark">Profile</a></li>
                        <li class="list-group-item py-3 bg-light"><a href="#" class="text-dark">My Order</a></li>
                        <li class="list-group-item py-3 bg-light"><a href="#" class="text-dark">My Wishlist</a></li>
                        <li class="list-group-item py-3 bg-light"><a href="{{route('customer.logout')}}" class="text-dark">Logout</a></li>

                    </ul>
                </div>
            </div>

            <div class="col-lg-9">
                <div class="card">
                    <div class="card-header">
                        <h3>Update Your Profile</h3>
                    </div>
                    <div class="card-body">



                           <form action="{{route('customer.update')}}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="row">

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label class="form-label">First Name</label>
                                            <input class="form-control" type="text" name="fname" value="{{Auth::guard('customer')->user()->fname}}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label class="form-label">Last Name</label>
                                            <input class="form-control" type="text" name="lname" value="{{Auth::guard('customer')->user()->lname}}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label class="form-label">Email</label>
                                            <input class="form-control" type="email" disabled name="email" value="{{Auth::guard('customer')->user()->email}}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label class="form-label">Password</label>
                                            <input class="form-control" type="password"  name="password" >
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label class="form-label">Phone</label>
                                            <input class="form-control" type="phone"  name="phone" value="{{Auth::guard('customer')->user()->phone}}" required>
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label class="form-label">Zip</label>
                                            <input class="form-control" type="text"  name="zip" value="{{Auth::guard('customer')->user()->zip}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label class="form-label">Address</label>
                                            <input class="form-control" type="address"  name="address" value="{{Auth::guard('customer')->user()->address}}">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="mt-3">
                                            <label class="form-label">Image</label>
                                            <input class="form-control" type="file"  name="photo">
                                            <img width="75" class="m-auto" src="{{asset('uploads')}}/customer/{{Auth::guard('customer')->user()->photo}}" alt="">
                                        </div>
                                    </div>

                                    <div class="col-lg-12">
                                        <div class="mt-3 text-center ">
                                           <button class="btn btn-primary px-5">Update</button>
                                        </div>
                                    </div>

                                </div>
                            </form>

                    </div>
                  </div>
            </div>


        </div>
    </div>
@endsection
