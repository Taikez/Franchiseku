@extends('admin.admin_master')
{{-- get header, sidebar, footer --}}

@section('admin')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

    <!-- Your modal in the Blade view -->
    <div class="modal fade" id="successModal" tabindex="-1" role="dialog" aria-labelledby="successModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="successModalLabel">Success Message</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <!-- Your success message content goes here -->
                    <p>{{ session('success_data.message') }}</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Your JavaScript to trigger the modal -->
    <script>
        @if (session()->has('success_data'))
            $(document).ready(function() {
                $("{!! session('success_data.modal') !!}").modal('show');
            });
        @endif
    </script>


    <div class="page-content">
        <div class="container-fluid">

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Add Franchise Category</h4>

                            <br>

                            <form action="{{ route('post.franchise.category') }}" method="POST">
                                @csrf

                                {{-- blog category  --}}
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">franchise Category
                                        Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="franchiseCategory" type="text"
                                            placeholder="franchise Category" id="example-text-input">
                                        @error('franchiseCategory')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="example-text-input" class="col-sm-2 col-form-label">Description</label>
                                    <div class="col-sm-10">
                                        <textarea name="franchiseCategoryDesc" class="form-control" id="franchiseCategoryDesc" cols="30" rows="10"
                                            placeholder="Put your description here.."></textarea>
                                        @error('franchiseCategoryDesc')
                                            <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <input type="submit" class="btn btn-info waves-effect waves-light" id="submitBtn"
                                    value="Insert Franchise Category" onclick="showLoading()">

                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>

        </div>
    </div>
@endsection
