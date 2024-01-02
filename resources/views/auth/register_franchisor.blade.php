@extends('layouts.guest')

@section('content')
    <div class="flex flex-col sm:justify-center items-center pt-6 sm:pt-0">
        <div class="w-full sm:max-w-md  bg-white text-start shadow-md overflow-hidden sm:rounded-lg">
            <div class="container-fluid text-center mx-auto">
                <div class="row login">
                    <div class="left-container col-sm-12 col-md-6 d-lg-flex justify-content-center flex-lg-column p-4 d-none d-sm-block"
                        data-aos="fade-right" data-aos-duration="800">

                        <div class="bg-overlay register-overlay"></div>
                        <h1 class="short-title" data-aos="fade-down-right" data-aos-duration="800">Learn Your Way to
                            Investment. Increase Your Financial Literacy. </h1>
                        <p class="short-title-desc" data-aos="fade-right" data-aos-duration="800">Get the most suitable
                            financial education material & content tailored for you</p>
                    </div>

                    <div class="right-container col-sm-12 col-md-6 bg-light p-4">
                        <div class="container-fluid text-center mx-auto" style="min-height:100vh">
                            <div class="mb-4">
                                <img src="{{ asset('authImg/franchiseku_logo.png') }}" class="z-full p-4" style="width: 60%"
                                    alt="" data-aos="fade-down-left" data-aos-duration="800">
                                <h1 class="form-title fs-3" data-aos="fade-left" data-aos-duration="800">
                                    @if (Request::is('register'))
                                        Create a Personal Account
                                    @elseif(Request::is('login'))
                                        Login
                                    @elseif(Request::is('registerFranchisor'))
                                        Create Franchisor Account
                                    @endif
                                </h1>
                            </div>

                            <form method="POST" class="bg-white rounded p-4" action="{{ route('register.franchisor') }}"
                                data-aos="fade-left" data-aos-duration="800">
                                @csrf
                                <!-- Name -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">{{ __('Name') }}</label>
                                    <input id="name" class="form-control" type="text" name="name"
                                        value="{{ old('name') }}" required autofocus autocomplete="name" />
                                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                </div>

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input id="email" class="form-control" type="email" name="email"
                                        value="{{ old('email') }}" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Phone Number -->
                                <div class="mb-3">
                                    <label for="phoneNumber" class="form-label">{{ __('Phone Number') }}</label>
                                    <input id="phoneNumber" class="form-control" type="text" name="phoneNumber"
                                        value="{{ old('phoneNumber') }}" required autocomplete="username" />
                                    <x-input-error :messages="$errors->get('phoneNumber')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" class="form-control" type="password" name="password" required
                                        autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Confirm Password -->
                                <div class="mb-3">
                                    <label for="password_confirmation"
                                        class="form-label">{{ __('Confirm Password') }}</label>
                                    <input id="password_confirmation" class="form-control" type="password"
                                        name="password_confirmation" required autocomplete="new-password" />
                                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                </div>

                                <div class="text-center justify-end mb-3">
                                    <button class="inputBtn mt-4 mb-3 w-100" type="submit">{{ __('Register') }}</button>

                                    <p>Already have an account?
                                        <a class="text-md text-success" href="{{ route('login') }}">
                                            {{ __('Log In') }}
                                        </a>
                                    </p>

                                    <a href="{{ route('register') }}">Register as
                                        User</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
