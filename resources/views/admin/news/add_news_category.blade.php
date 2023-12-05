@extends('admin.admin_master')
{{-- get header, sidebar, footer --}}

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Portfolio Page</h4>

                            <br>

                            <form action="{{ route('post.news.category') }}" method="POST">
                                @csrf


                                {{-- blog category  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">News Category
                                        Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="newsCategory" type="text" placeholder="Title"
                                            id="example-text-input">
                                        @error('newsCategory')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" id="submitBtn"
                                    value="Insert News Category" onclick="showLoading()">

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>
@endsection
