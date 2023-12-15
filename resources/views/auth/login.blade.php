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
                            Build Your Future. <br> Plan Better. <br> Organize
                            Better.</h1>
                        <p class="short-title-desc" data-aos="fade-right" data-aos-duration="800">Get the most suitable
                            franchise investment with the correct knowledge and
                            category suited for you</p>
                    </div>

                    <div class="right-container col-sm-12 col-md-6 bg-light p-4">

                        <div class="container-fluid text-center mx-auto" style="min-height:100vh; margin: 0 0 ;">
                            <x-auth-session-status class="mb-4" :status="session('status')" />

                            <div class="mb-4">
                                <img src="{{ asset('authImg/franchiseku_logo.png') }}" class="z-full p-4" style="width: 60%"
                                    alt="" data-aos="fade-down-left" data-aos-duration="800">
                                <h1 class="form-title fs-3">
                                    @if (Request::is('register'))
                                        <div data-aos="fade-left" data-aos-duration="800">
                                            Create a Personal Account
                                        </div>
                                    @elseif(Request::is('login'))
                                        <div data-aos="fade-left" data-aos-duration="800">
                                            Login
                                        </div>
                                    @endif
                                </h1>
                            </div>

                            <form method="POST" class="bg-white rounded p-4" action="{{ route('login') }}"
                                data-aos="fade-left" data-aos-duration="800">
                                @csrf

                                <!-- Email Address -->
                                <div class="mb-3">
                                    <label for="email" class="form-label">{{ __('Email') }}</label>
                                    <input id="email" class="form-control" type="email" name="email"
                                        placeholder="Enter your email" value="{{ old('email') }}" required autofocus
                                        autocomplete="username">
                                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                </div>

                                <!-- Password -->
                                <div class="mb-3">
                                    <label for="password" class="form-label">{{ __('Password') }}</label>
                                    <input id="password" class="form-control" type="password" name="password"
                                        placeholder="Enter your password" required autocomplete="current-password">
                                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                </div>

                                <!-- Remember Me -->
                                <div class="mb-3 mt-3 form-check text-start">
                                    <input id="remember_me" class="form-check-input" type="checkbox" name="remember">
                                    <label for="remember_me" class="form-check-label">{{ __('Remember me') }}</label>
                                </div> 


                                <div class="mb-3">
                                    {{-- nanti baru di edit  --}}
                                    <a class="btn btn-light" href="/auth/google/redirect"> <img src="https://img.icons8.com/color/16/000000/google-logo.png"> Login with google</a>
                                </div>




                                <div class="mb-3 text-start">
                                    @if (Route::has('password.request'))
                                        <a class="text-sm text-success fw-bold text-decoration-none"
                                            href="{{ route('password.request') }}">
                                            {{ __('Forgot your password?') }}
                                        </a>
                                    @endif

                                    <button type="submit" class="inputBtn mt-3">{{ __('Log in') }}</button>

                                    <p class="mt-3">Don't have an account?
                                        <a class="text-success" href="{{ route('register') }}">
                                            {{ __('Create an account') }}
                                        </a>
                                    </p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
