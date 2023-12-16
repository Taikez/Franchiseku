@extends('admin.admin_master')
{{-- get header, sidebar, footer --}}

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <style type="text/css">
        .bootstrap-tagsinput .tag {
            margin-right: 2px;
            color: #b70000;
            font-weight: 700px;
        }
    </style>
   
    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Edit News Page</h4>

                            <form action="{{ route('update.news') }}" method="POST" enctype="multipart/form-data">
                                @csrf

                                {{-- get id  --}}
                                <input type="hidden" name="id" value="{{$news->id}}">

                                {{-- News Category  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">News Category</label>
                                    <div class="col-sm-10">
                                        <select name="newsCategoryId" class="form-select" aria-label="Default select example">
                                                <option selected="">Choose Category</option>
                                            @foreach ($categories as $item)
                                                <option value="{{ $item->id }}" {{ $news->newsCategoryId == $item->id ? 'selected' : '' }}>{{ $item->newsCategory }}</option>
                                            @endforeach
                                        </select>
                                         @error('newsCategoryId')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- News title  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">News Title</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="newsTitle" type="text" value="{{$news->newsTitle}}" placeholder="Title"
                                            id="example-text-input">
                                        @error('newsTitle')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- News Author  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">News Author</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="newsAuthor" value="{{$news->newsAuthor}}" type="text" placeholder="Author"
                                            id="example-text-input">
                                        @error('newsAuthor')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- News description  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">News Content</label>
                                    <div class="col-sm-10">
                                        <textarea id="elm1" name="newsContent">
                                            <p>{!! $news->newsContent !!}</p>
                                        </textarea>
                                    </div>
                                </div>

                                {{-- News Tags  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">News Tags</label>
                                    <div class="col-sm-10">
                                        <input class="form-control"  name="newsTags" value="{{$news->newsTags}}"
                                            type="text" data-role="tagsinput" id="example-text-input">
                                    </div>
                                </div>

                                {{-- News Image  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">News Image</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="newsImage" type="file" placeholder="News Image"
                                            id="image">
                                        @error('newsImage')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                {{-- Image Display  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                    <div class="col-sm-10">
                                        <img id="showImage" style="width: 128px" class="rounded avatar-lg"
                                            src="{{ asset($news->newsImage) }}" alt="Card image cap">
                                    </div>
                                </div>


                                <input type="submit" class="btn btn-info waves-effect waves-light" id="submitBtn"
                                    value="Update News Data" onclick="showLoading()">

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>


    <script>
        $(document).ready(function() {
            $('#image').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                    console.log(e.target.result);
                }

                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
