@extends('layouts.admin')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Offer 1</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('offer1.store', $offer1->first()->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$offer1->first()->title}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">After Discount</label>
                            <input type="number" class="form-control" name="after_discount" value="{{$offer1->first()->after_discount}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Price</label>
                            <input type="number" class="form-control" name="price" value="{{$offer1->first()->price}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Date</label>
                            <input type="date" class="form-control" name="date" value="{{$offer1->first()->date}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image"  onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                            <img class="mt-3" src="{{asset('uploads/offer')}}/{{$offer1->first()->image}}" id="blah" alt="your image"  height="100" />
                        </div>

                        <div class="mb-3">
                           <button class="btn btn-primary"> Update Offer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h4>Offer 2</h4>
                </div>
                <div class="card-body">
                    <form action="{{route('offer2.store',$offer2->first()->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                        <div class="mb-3">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control" name="title" value="{{$offer2->first()->title}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Sub Title</label>
                            <input type="text" class="form-control" name="subtitle" value="{{$offer2->first()->subtitle}}">
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Image</label>
                            <input type="file" class="form-control" name="image"  onchange="document.getElementById('blah2').src = window.URL.createObjectURL(this.files[0])">
                            <img class="mt-3" src="{{asset('uploads/offer')}}/{{$offer2->first()->image}}" id="blah2" alt="your image"  height="100" />
                        </div>

                        <div class="mb-3">
                           <button class="btn btn-primary"> Update Offer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

