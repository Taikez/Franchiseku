{{-- <x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Profile') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-profile-information-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.update-password-form')
                </div>
            </div>

            <div class="p-4 sm:p-8 bg-white shadow sm:rounded-lg">
                <div class="max-w-xl">
                    @include('profile.partials.delete-user-form')
                </div>
            </div>
        </div>
    </div>
</x-app-layout> --}}


@extends('layouts.app')

@section('main')
    @include('modals.update-password-success-modal')

    <div class="container bg-white mx-auto p-4 m-4 rounded">

        <div class="row border-bottom p-2">
            <div class="col-md-12 d-flex align-items-center">
                <span class="material-symbols-outlined fs-1 m-2 me-4">person</span>

                <div class="ml-3">
                    <h1 class="fs-3">{{ ucwords($user->name) }} / Change Password</h1>
                    <h2 class="fw-light fs-5 text-secondary">Manage your personal information</h2>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-4 p-3 px-4">
                <div class="row">
                    <p class="fw-medium fs-4">Change <br> Password </p>
                </div>
                {{-- <div class="row text-secondary fs-5" style=""  >
                    <div class="col-md-8">
                        <a href=""> >>General</a>
                    </div>
                </div> --}}
                <div class="row text-secondary fs-5 mt-3" style="">
                    <div class="col-md-8">
                        <ul class="update-profile-sidebar-menu">
                            <li>
                                <a href="{{ route('profile.edit') }}">General</a>
                            </li>
                            <li>
                                <a href="{{ route('change.password') }}">Password</a>
                            </li>
                        </ul>
                    </div>
                </div>

                <div class="row ">
                    <div class="col-md-8 pt-3 mt-4 border-top">
                        <a href="" class=" fs-5 text-danger">Delete Account</a>
                    </div>
                </div>

            </div>


            <div class="col-md-8 py-4">
                <form method="POST" action="{{ route('update.password') }}">
                    @csrf

                    <!-- Old Password -->
                    <div class="form-group mb-3">
                        <label for="old_password">{{ __('Old Password') }}</label>
                        <input id="old_password" type="password"
                            class="form-control @error('old_password') is-invalid @enderror" name="old_password">
                        @error('old_password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror

                    </div>

                    <!-- New Password -->
                    <div class="form-group mb-3">
                        <label for="password">{{ __('New Password') }}</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror"
                            name="password" required>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <!-- Confirm New Password -->
                    <div class="form-group mb-3">
                        <label for="password-confirm">{{ __('Confirm New Password') }}</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation"
                            required>
                    </div>

                    <button type="submit" class="btn btn-primary mt-3">
                        {{ __('Change Password') }}
                    </button>

                </form>


            </div>
        </div>

    </div>

    {{-- success modal --}}
    <script>
        $(document).ready(function() {
            @if (session('success')) // Check if there is a "success" variable in your session data
                $('#successModal').modal('show'); // Show the success modal
            @endif
        });
    </script>


    {{-- appear success modal --}}
    {{-- @if (session('password_change_success'))
        <script>
            $(document).ready(function () {
                $('#successModal').modal('show');
            });
        </script>
    @endif --}}

    @if (session('password_change_success'))
        <div class="alert alert-success">
            Password changed successfully!
        </div>
    @endif






    <script>
        $(document).ready(function() {
            $('#profileImage').change(function(e) {
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
