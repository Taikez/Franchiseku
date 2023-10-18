@extends('admin.admin_master') 
{{-- get header, sidebar, footer --}}

@section('admin')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<style type="text/css">
    .bootstrap-tagsinput .tag{
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

                        <h4 class="card-title">Add Education Page</h4>
                     
                        <form action="{{route('post.education')}}" method="POST" enctype="multipart/form-data" >
                            @csrf
                            @method('POST')


                            {{-- Education Category  --}}
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Category</label>
                                <div class="col-sm-10">
                                    <select name="educationCategory" class="form-select" aria-label="Default select example">
                                        <option selected="">Choose Education Category</option>
                                        @foreach ($educationCategories as $item)
                                            <option value="{{$item->id}}">{{$item->educationCategory}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                             {{-- Education title  --}}
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Title</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="educationTitle" type="text" placeholder="Title" id="example-text-input">
                                    @error('educationTitle')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror 
                                </div>
                            </div>

                            {{-- Education Author  --}}
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Author</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="educationAuthor" type="text" placeholder="Author" id="example-text-input">
                                    @error('educationAuthor')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror 
                                </div>
                            </div>

                            {{-- Educationn Price --}}
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Price (Rp)</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="educationPrice" type="number" placeholder="Price" id="example-text-input">
                                    @error('educationPrice')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror 
                                </div>
                            </div>

                              {{-- Educationn Shord Desc --}}
                              <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Short Description</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="educationShortDesc" type="text" placeholder="Short Description" id="example-text-input">
                                    @error('educationShortDesc')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror 
                                </div>
                            </div>

                            {{-- Education description  --}}
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Description</label>
                                <div class="col-sm-10">
                                    <textarea id="elm1" name="educationDesc">
                                    </textarea>
                                </div>
                            </div>

                             {{-- Education Image  --}}
                             <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label">Education Thumbnail</label>
                                <div class="col-sm-10">
                                    <input class="form-control" name="educationThumbnail" type="file" placeholder="Education Video" id="image" >
                                    @error('educationThumbnail')
                                       <span class="text-danger">{{$message}}</span>
                                   @enderror 
                                </div>
                            </div>

                             {{-- Image Display  --}}
                            <div class="row mb-3">
                                <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                                <div class="col-sm-10">
                                    <img id="showImage" style="width: 128px" class="rounded avatar-lg" src="{{(url('upload/no_image.jpg'))}}" alt="Card image cap">
                                </div>
                            </div>

                            {{-- Education Video --}}
                            <div class="row mb-3">
                                <label class="col-sm-2 col-form-label" for="educationVideo">Select Education Video</label>
                                <div class="col-sm-10">
                                    <input class="form-control" type="file" name="educationVideo" id="educationVideo" accept=".mp4,.mov,.avi,.mkv,.wmv"/>
                                    @error('educationVideo')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>


                            <input type="submit" class="btn btn-info waves-effect waves-light" id="submitBtn" value="Insert Education Data">

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