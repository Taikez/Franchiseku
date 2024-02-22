@extends('layouts.guest')

@section('content')
    <div class="flex flex-col sm:justify-center  items-center sm:pt-0">
        <div class="w-full sm:max-w-md text-start shadow-md overflow-hidden sm:rounded-lg">
            <div class="container-fluid text-center mx-auto">
                <div class="row login">
                    <div class="left-container col-sm-12 col-md-6 d-lg-flex justify-content-center flex-lg-column p-4 d-none d-sm-block"
                        data-aos="fade-down-right" data-aos-duration="800">
                        <div class="bg-overlay register-overlay"></div>
                        <h1 class="short-title text-start lh-base fs-2" data-aos="fade-down-right" data-aos-duration="800">
                            Build Your Future. <br> 
                            Plan Better. <br> 
                            Organize Better.
                        </h1>
                        <p class="short-title-desc" data-aos="fade-right" data-aos-duration="800">Create a new and stronger password than before. Fill in your new password on the form.</p>
                    </div>
                    <div class="right-container col-sm-12 col-md-6 bg-light p-4">
                        <div class="container-fluid text-center mx-auto" style="min-height:100vh; margin: 0 0 ;">
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <div class="mb-4">
                                <img src="{{ asset('authImg/franchiseku_logo.png') }}" class="z-full p-4" style="width: 60%"
                                    alt="" data-aos="fade-down-left" data-aos-duration="800">
                                <h1 class="form-title fs-3">
                                    <div data-aos="fade-left" data-aos-duration="800">
                                        Reset Password
                                    </div>
                                </h1>
                            </div>
                            <!-- Session Status -->
                            <x-auth-session-status class="mb-4" :status="session('status')" />
                            <form method="POST" class="bg-white rounded p-4" action="{{ route('password.store') }}" data-aos="fade-left" data-aos-duration="800">
                                @csrf
                                <!-- Password Reset Token -->
                                <input type="hidden" name="token" value="{{ $request->route('token') }}">
                                <!-- Email Address -->
                                <div class="mb-3">
                                    <x-text-input id="email" class="form-control" type="hidden" name="email" :value="old('email', $request->email)" required autofocus autocomplete="username"/>
                                    <x-input-error :messages="$errors->get('email')" class="mt-2 text-danger" />
                                </div>
                                <!-- New Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('New Password') }}</label>
                                    <input id="password" class="form-control" type="password" name="password" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2 text-danger" />
                                </div>
                                <!-- Confirm New Password -->
                                <div class="mb-3">
                                    <label for="password_confirmation" class="form-label">{{ __('Confirm New Password') }}</label>
                                    <input id="password_confirmation" class="form-control" type="password" name="password_confirmation" required autocomplete="new-password">
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2 text-danger" />
                                </div>
                                <div class="flex items-center justify-end mt-4">
                                    <x-primary-button>
                                        {{ __('Create New Password') }}
                                    </x-primary-button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
