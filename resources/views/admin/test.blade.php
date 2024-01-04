@extends('layouts.admin')

{{-- @section('header')
<link  rel="stylesheet"  href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.15.2/css/selectize.default.min.css"  integrity="sha512-pTaEn+6gF1IeWv3W1+7X7eM60TFu/agjgoHmYhAfLEU8Phuf6JKiiE8YmsNC0aCgQv4192s4Vai8YZ6VNM6vyQ=="crossorigin="anonymous" referrerpolicy="no-referrer"/>

@endsection --}}



@section('style')
.img-thumbs {
    background: #eee;
    border: 1px solid #ccc;
    border-radius: 0.25rem;
    margin: 1.5rem 0;
    padding: 0.75rem;
  }
  .img-thumbs-hidden {
    display: none;
  }

  .wrapper-thumb {
    position: relative;
    display: inline-block;
    margin: 1rem 0;
    justify-content: space-around;
  }

  .img-preview-thumb {
    background: #fff;
    border: 1px solid none;
    border-radius: 0.25rem;
    box-shadow: 0.125rem 0.125rem 0.0625rem rgba(0, 0, 0, 0.12);
    margin-right: 1rem;
    max-width: 140px;
    padding: 0.25rem;
  }

  .remove-btn {
    position: absolute;
    display: flex;
    justify-content: center;
    align-items: center;
    font-size: 0.7rem;
    top: -5px;
    right: 10px;
    width: 20px;
    height: 20px;
    background: white;
    border-radius: 10px;
    font-weight: bold;
    cursor: pointer;
  }

  .remove-btn:hover {
    box-shadow: 0px 0px 3px grey;
    transition: all 0.3s ease-in-out;
  }

@endsection


@section('content')



<input type="text" id="input-tags" value="" />











<div class="row">
    <div class="col-lg-12">

        <div class="">
            <h3 class="text-center">Multiple Upload Images and Remove Button </h3>

                <div  id="form-upload">
                  <div class="form-group mt-5">
                    <label for="">Choose Images</label>
                    <input type="file" class="form-control" name="images[]" multiple id="upload-img" />
                  </div>
                  <div class="img-thumbs img-thumbs-hidden" id="img-preview"></div>


             </div>

          </div>


    </div>
</div>



















@endsection


@section('footer_script')


<script>
    var imgUpload = document.getElementById('upload-img')
  , imgPreview = document.getElementById('img-preview')
  , imgUploadForm = document.getElementById('form-upload')
  , totalFiles
  , previewTitle
  , previewTitleText
  , img;

imgUpload.addEventListener('change', previewImgs, true);

function previewImgs(event) {
  totalFiles = imgUpload.files.length;

     if(!!totalFiles) {
    imgPreview.classList.remove('img-thumbs-hidden');
  }

  for(var i = 0; i < totalFiles; i++) {
    wrapper = document.createElement('div');
    wrapper.classList.add('wrapper-thumb');
    removeBtn = document.createElement("span");
    nodeRemove= document.createTextNode('x');
    removeBtn.classList.add('remove-btn');
    removeBtn.appendChild(nodeRemove);
    img = document.createElement('img');
    img.src = URL.createObjectURL(event.target.files[i]);
    img.classList.add('img-preview-thumb');
    wrapper.appendChild(img);
    wrapper.appendChild(removeBtn);
    imgPreview.appendChild(wrapper);

    $('.remove-btn').click(function(){
      $(this).parent('.wrapper-thumb').remove();
    });

  }


}
</script>



{{--
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
</script> --}}



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
@endsection
