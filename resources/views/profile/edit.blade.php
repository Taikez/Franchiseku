
@extends('layouts.app')

@section('main')
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

    <div class="container bg-white mx-auto p-4 m-4 rounded" data-aos="fade-down-right" data-aos-duration="800">

        <div class="row border-bottom p-2">
            <div class="col-md-12 d-flex align-items-center">
                <span class="material-symbols-outlined fs-1 m-2 me-4">person</span>

                <div class="ml-3">
                    <h1 class="fs-3">{{ ucwords($user->name) }} / General</h1>
                    <h2 class="fw-light fs-5 text-secondary">Manage your personal information</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 p-3 px-4">
                <div class="row">
                    <p class="fw-medium fs-4">Change Password </p>
                </div>
                {{-- <div class="row text-secondary fs-5" style=""  >
                    <div class="col-md-8">
                        <a href=""> >>General</a>
                    </div>
                </div> --}}
                <div class="row text-secondary fs-5 mt-3" style="">
                    <div class="col-md-8">
                        <ul class="update-profile-sidebar-menu">
                            <li data-aos="fade-right" data-aos-duration="800">
                                <a href="{{ route('profile.edit') }}">General</a>
                            </li>
                            <li data-aos="fade-left" data-aos-duration="800">
                                <a href="{{ route('change.password') }}">Password</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-8 pt-3 mt-4 border-top" data-aos="zoom-in-right" data-aos-duration="800">
                        <a href="" class=" fs-5 text-danger">Delete Account</a>
                    </div>
                </div>

            </div>
            <div class="col-md-8">
                <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <input type="hidden" name="id" id="id" value="{{ $user->id }}">

                    <div class="form-group mt-3">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control"
                            value="{{ old('name', $user->name) }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control"
                            value="{{ old('email', $user->email) }}" required>
                    </div>

                    <div class="form-group mt-3">
                        <label for="phoneNumber">Phone Number</label>
                        <input type="text" name="phoneNumber" id="phoneNumber" class="form-control"
                            value="{{ old('phoneNumber', $user->phoneNumber) }}">
                    </div>

                    {{-- Profile Image  --}}
                    <div class=" form-group  mt-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label">Profile Image</label>
                        <div class="col-sm-10 col-md-12">
                            <input class="form-control" name="profileImage" type="file" placeholder="Name"
                                id="profileImage" value="{{ $user->profileImage }}">
                        </div>
                    </div>

                    {{-- Image Display  --}}
                    <div class="form-group mt-3">
                        <label for="example-text-input" class="col-sm-2 col-form-label"></label>
                        <div class="col-sm-10 col-md-4">
                            <button id="deleteImage" class="btn btn-sm mb-2 btn-danger">Delete Image</button>
                            <img id="showImage" class="img-fluid rounded avatar-lg"
                                src="{{ !empty($user->profileImage) ? url($user->profileImage) : url('upload/no_image.jpg') }}"
                                alt="Card image cap">
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </div>
                </form>
            </div>
        </div>


        {{-- @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif --}}


        <!-- Success Modal -->
       @include('../modals/success-modal')



    </div>

    {{-- success modal --}}
    <script>
        $(document).ready(function() {
            @if (session('success')) // Check if there is a "success" variable in your session data
                $('#successModal').modal('show'); // Show the success modal
            @endif
        });
    </script>


    {{-- delete image button --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteImageButton = document.getElementById('deleteImage');
            const profileImageInput = document.getElementById('profileImage');
            const showImage = document.getElementById('showImage');

            deleteImageButton.addEventListener('click', function(event) {
                event.preventDefault(); // Prevent the default form submission behavior

                // Clear the profile image input field
                profileImageInput.value = '';

                // Set the image source to a default image or hide it
                showImage.src = '{{ url('upload/no_image.jpg') }}';
                showImage.alt = 'Card image cap';
            });
        });
    </script>



    <script>
        $(document).ready(function() {
            $('#profileImage').change(function(e) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#showImage').attr('src', e.target.result);
                    // console.log(e.target.result);
                }

                reader.readAsDataURL(e.target.files['0']);
            });
        });
    </script>
@endsection
