@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card">
                <div class="card-header">
                    <h4>Big Offer</h4>
                </div>
                <div class="card-body">
                   <div class="col-lg-8 m-auto border border-3">
                    <form action="{{route('big.offer.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mt-3">
                            <label class="label-control">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$big_offer->first()->title}}">
                            @error('title')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label class="label-control">Shape 1</label>
                            <input type="text" class="form-control" name="shape1" value="{{$big_offer->first()->shape1}}">
                            @error('shape1')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="label-control">Percentage</label>
                            <input type="number" class="form-control" name="percentage" value="{{$big_offer->first()->percentage}}">
                            @error('percentage')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>

                        <div class="mt-3">
                            <label class="label-control">Shape 2</label>
                            <input type="text" class="form-control" name="shape2" value="{{$big_offer->first()->shape2}}">
                            @error('shape2')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <label class="label-control">Image</label>
                            <input type="file" class="form-control" name="image" onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img class="mt-3" src="{{asset('uploads/offer')}}/{{$big_offer->first()->image}}" id="blah" alt="your image"  height="100" />
                            @error('image')
                                <div class="text-danger">{{$message}}</div>
                            @enderror
                        </div>
                        <div class="mt-3 mb-4">
                            <button class="btn btn-info">Add Offer</button>
                        </div>
                        </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
