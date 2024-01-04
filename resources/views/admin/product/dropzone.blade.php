<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Image Dropzone</title>

    {{-- Bootstrap 5.3 --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">

    {{-- Dropzone.JS CDN --}}
    <link rel="stylesheet" href="https://unpkg.com/dropzone@5/dist/min/dropzone.min.css" type="text/css" />

    {{-- Custom Style --}}
    <style>
        main {
            height: 100vh;
        }

        main .container,
        .row {
            height: 100%;
        }

        /* Copy from here */
        .dropzone {
            min-height: auto;
            border: 1px solid #d1d1d1;
            background: #fff;
            padding: 4px;
            border-radius: 5px
        }

        .dropzone .dz-preview {
            margin: 8px;
            min-height: 60px;
        }

        .dropzone .dz-preview .dz-details {
            display: none;
        }

        .dropzone .dz-preview .dz-image {
            border-radius: 5px;
            width: 60px;
            height: 60px;
            z-index: 5;
        }

        .dropzone .dz-preview .dz-progress {
            z-index: 10;
            height: 6px;
            left: 84%;
            top: 44%;
            margin-top: -8px;
            width: 40px;
            margin-left: -40px;
            border-radius: 8px;
        }

        .dropzone .dz-preview .dz-error-message {
            border-radius: 8px;
            font-size: 13px;
            top: -40px;
            left: -42px;
            width: 140px;
            padding: 0.3em 0.2em;
            color: #fff;
            text-align: center;
            z-index: 16;
        }

        .dropzone .dz-preview .dz-success-mark,
        .dropzone .dz-preview .dz-error-mark {
            top: 52%;
            left: 68%;
            margin-left: -27px;
            margin-top: -27px;
            z-index: 11;
        }

        .dropzone .dz-preview .dz-success-mark svg,
        .dropzone .dz-preview .dz-error-mark svg {
            display: block;
            width: 32px;
            height: 32px;
        }

        .dropzone .dz-size  {
            display: none;
        }

        .dropzone .dz-preview .dz-error-message:after {
            top: 96%;
            left: 64px;
            width: 0;
            height: 0;
            transform: rotate(180deg);
            z-index: 15;
        }
        /* end copy */
    </style>
<body>
    <main>
        <div class="container">
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Image Dropzone :</h4>
                        </div>
                        <div class="card-body">
                            <form action="/dropzone/post" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-2">
                                    <label class="form-label">Name *</label>
                                    <input type="text" placeholder="Your name" class="form-control" name="name">
                                    @error('name')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                <div class="mb-2">
                                    <label class="form-label">Email *</label>
                                    <input type="email" placeholder="Your name" class="form-control" name="email">
                                    @error('email')
                                        <strong class="text-danger">{{$message}}</strong>
                                    @enderror
                                </div>
                                {{-- Copy from here --}}
                                <div class="mb-2">
                                    <label class="form-label">Gallery *</label>
                                    <div id="dropzone" class="dropzone"></div>
                                </div>
                                {{-- End copy --}}
                                <div class="text-center mt-2">
                                    <button class="btn btn-primary w-50" type="submit">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- Bootstrap 5.3 --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Dropzone.JS CDN --}}
    <script src="https://unpkg.com/dropzone@5/dist/min/dropzone.min.js"></script>

    {{-- Custom JS --}}
    <script>

        // Copy from here
        var thisDropzone = new Dropzone("#dropzone", {
            url: "/dropzone/post",
            method: "POST",
            paramName: "file",
            autoProcessQueue : true,
            acceptedFiles: "image/*",
            maxFiles: 10, // How many files
            maxFilesize: 1, // File mb size
            uploadMultiple: true,
            parallelUploads: 100,
            createImageThumbnails: true,
            thumbnailWidth: 120,
            thumbnailHeight: 120,
            addRemoveLinks: true,
            timeout: 180000,
            dictRemoveFile: "Remove",
            dictDefaultMessage: "Uploads from here!", // Upload area caption
        }) ;
        // end copy
    </script>
</head>
</body>
</html>
