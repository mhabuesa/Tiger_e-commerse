@extends('layouts.admin')
@section('style')
.current_gallery{
    margin-top:6px;
    padding:6.5px;
    display:block;
    border: 1px solid #E8EBF1;
}
@endsection


@section('content')



<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4>Product Details of <strong class=" p-1">{{$product->product_name}}</strong></h4>
                @if (session('product_update'))
                     <div class="alert alert-success">{{session('product_update')}} </div>
                 @endif
            </div>
            <div class="card-body">
@if (session('success'))
    <div class="alert alert-success">{{session('success')}}</div>
@endif
                <form action="{{route('product.edit', $product->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-lg-6">
                           <div class="mb-3">
                            <label for="" class="form-label"> Category </label>

                            <select name="category_id" class="form-control category">
                                <option value=""> Select Category</option>
                                @foreach ($categories as $category )

                                <option value="{{$category->id}}"> {{$category->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <strong class="text-danger"> {{$message}}</strong>
                         @enderror
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="mb-3">
                            <label for="" class="form-label">Sub Category </label>

                            <select name="subcategory_id" class="form-control subcategory">
                                <option value=""> Select Sub Category</option>


                            </select>
                        </select>
                        @error('subcategory_id')
                            <strong class="text-danger"> {{$message}}</strong>
                        @enderror
                           </div>
                        </div>
                        <div class="col-lg-6">
                           <div class="mb-3">
                            <label for="" class="form-label">Brand </label>
                            <select name="brand_id" class="form-control">
                                <option value=""> Select Brand</option>
                                @foreach ($brands as $brand )

                                <option {{$brand->id == $product->brand_id?'selected':''}}  value="{{$brand->id}}"> {{$brand->brand_name}}</option>
                                @endforeach
                            </select>
                        </select>
                        @error('brand_id')
                        <strong class="text-danger"> {{$message}}</strong>
                     @enderror
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="mb-3">
                            <label for="" class="form-label">Product Name </label>
                            <input type="text" name="product_name" class="form-control" value="{{$product->product_name}}">
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="mb-3">
                            <label for="" class="form-label">Price </label>
                            <input type="number" name="price" class="form-control" value="{{$product->price}}">
                           </div>
                        </div>

                        <div class="col-lg-6">
                           <div class="mb-3">
                            <label for="" class="form-label">Discount (%)</label>
                            <input type="number" name="discount" class="form-control" value="{{$product->discount == null?'0':$product->discount}}">
                           </div>
                        </div>


                        <div class="col-lg-12">
                           <div class="mb-3">
                            <label for="" class="form-label">Tags </label>
                            <input type="text"  id="input-tags" name="tags[]" class="" value="{{$product->tags}}">
                           </div>
                        </div>


                        <div class="col-lg-12">
                           <div class="mb-3">
                            <label for="" class="form-label">Short Description </label>
                           <textarea  class="form-control" name="short_desp" id="" cols="30" rows="10">{{$product->short_desp}}</textarea>
                           </div>
                        </div>

                        <div class="col-lg-12">
                           <div class="mb-3">
                            <label for="" class="form-label">Long Description </label>
                           <textarea id="summernote"  class="form-control" name="long_desp">{!!$product->long_desp!!}</textarea>
                           </div>
                        </div>

                        <div class="col-lg-12">
                           <div class="mb-3">
                            <label for="" class="form-label">Additional Info </label>
                          <textarea id="summernote2"  class="form-control" name="addi_info"  cols="30" rows="10">{!!$product->addi_info!!}</textarea>
                           </div>
                        </div>



                        <div class="col-lg-6">
                            <div class="mb-3">
                             <label for="" class="form-label">Preview Image </label>
                             <input type="file" name="preview" class="form-control"
                             onchange="document.getElementById('blah').src = window.URL.createObjectURL(this.files[0])">
                             <img class="mt-3"  height="150" id="blah" src="{{asset('uploads/product/preview')}}/{{$product->preview}}" title="Product Image" alt="">
                            </div>
                         </div>



                        <div class="col-lg-6 mt-4 mb-2">
                            <strong class="form-label current_gallery">Current Gallery Images</strong>

                           <div class="mt-3">
                            @foreach (App\Models\Gallery::where('product_id', $product->id)->get() as $galleries )

                            <img title="{{$galleries->gallery}}" height="150" src="{{asset('uploads/product/gallery')}}/{{$galleries->gallery}}" alt="">
                            @endforeach
                           </div>

                        </div>


                        <div class="col-lg-12 mt-5">
                            <label class="form-label">Gallery Images</label>
                            <div class="upload__box">
                                <div class="upload__btn-box">
                                  <label class="upload__btn">
                                    <p class="">Upload Product Gallery images</p>
                                    <input type="file" name="gallery[]" multiple="" data-max_length="20" class="upload__inputfile">
                                  </label>
                                </div>
                                <div class="upload__img-wrap"></div>
                              </div>
                        </div>






                        <div class="col-lg-6 m-auto mt-3">
                           <div class="mb-3 ">
                           <button class="btn btn-primary w-100">Product Update</button>
                           </div>
                        </div>

                    </div>
                </form>



            </div>
        </div>
    </div>
</div>


@endsection

@section('footer_script')

<script>
    $("#input-tags").selectize({
  delimiter: ",",
  persist: false,
  create: function (input) {
    return {
        value: input,
        text: input,
    };
  },
});
</script>





<script>
    $('.category').change(function(){
        var category_id = $(this).val();

        $.ajaxSetup({
            headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });


        $.ajax({
            url:'/getSubcategory',
            type:'POST',
            data:{'category_id':category_id},
            success: function (data){
              $('.subcategory').html(data);
            }
        })
})
</script>

<script>
    $(document).ready(function() {
  $('#summernote').summernote();
  $('#summernote2').summernote();
});
</script>
<script>
   jQuery(document).ready(function () {
  ImgUpload();
});

function ImgUpload() {
  var imgWrap = "";
  var imgArray = [];

  $('.upload__inputfile').each(function () {
    $(this).on('change', function (e) {
      imgWrap = $(this).closest('.upload__box').find('.upload__img-wrap');
      var maxLength = $(this).attr('data-max_length');

      var files = e.target.files;
      var filesArr = Array.prototype.slice.call(files);
      var iterator = 0;
      filesArr.forEach(function (f, index) {

        if (!f.type.match('image.*')) {
          return;
        }

        if (imgArray.length > maxLength) {
          return false
        } else {
          var len = 0;
          for (var i = 0; i < imgArray.length; i++) {
            if (imgArray[i] !== undefined) {
              len++;
            }
          }
          if (len > maxLength) {
            return false;
          } else {
            imgArray.push(f);

            var reader = new FileReader();
            reader.onload = function (e) {
              var html = "<div class='upload__img-box'><div style='background-image: url(" + e.target.result + ")' data-number='" + $(".upload__img-close").length + "' data-file='" + f.name + "' class='img-bg'><div class='upload__img-close'></div></div></div>";
              imgWrap.append(html);
              iterator++;
            }
            reader.readAsDataURL(f);
          }
        }
      });
    });
  });

  $('body').on('click', ".upload__img-close", function (e) {
    var file = $(this).parent().data("file");
    for (var i = 0; i < imgArray.length; i++) {
      if (imgArray[i].name === file) {
        imgArray.splice(i, 1);
        break;
      }
    }
    $(this).parent().parent().remove();
  });
}
</script>
@endsection
