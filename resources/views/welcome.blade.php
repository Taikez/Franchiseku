<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>FranchiseKu</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
          <link rel="preconnect" href="https://fonts.googleapis.com">
          <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
          <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&family=Roboto:wght@100;300;500;700;900&display=swap" rel="stylesheet">
        
        <link rel="stylesheet" href="{{asset('css/auth.css')}}">
        <link rel="stylesheet" href="{{asset('css/app.css')}}">

        {{-- Toaster --}}
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >

        {{-- icon --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        
        <!-- Styles -->
        <!-- Bootstrap Css -->
        {{-- <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet"  /> --}}
        
       <!-- Scripts -->
        <script src="{{asset('backend/assets/libs/jquery/jquery.min.js')}}"></script>
        {{-- <script src="{{asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js')}}"></script> --}}

       @vite('resources/css/header.css') 
       @vite(['resources/css/app.css','resources/sass/app.scss','resources/js/app.js']) 
    </head>
    <body class="antialiased border-0">
           {{-- login validation --}}
            @if (Route::has('login'))
                {{-- <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Dashboard</a>
                        @include('layouts.guest_header')
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Log in</a>

                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">Register</a>
                        @endif
                    @endauth
                </div> --}}
                <div class="">
                    @if(auth()->check())
                        @if (auth()->user()->role == 'Franchisor')
                        @endif
                        @include('layouts.guest_header')
                    @else        
                        @include('layouts.guest_header')
                    @endif
                </div>
                
            @endif
            
            <div id="banner" class="container-fluid p-5 mb-5">
                <div class="row d-flex align-items-center justify-content-center mb-5">
                    <div id="banner-left" class="col-lg-6 col-md-8 col-sm-12 p-2">
                        <div class="float-right">
                            <h1 id="banner-title" class="fw-bold mb-4" style="color:#015051;">Organize your money investment</h1>
                            <p style="font-size: 20px">
                                We will help you organize, learn and <br>
                                <span class="fw-bold" style="color: #015051; font-size: 20px">Look for an investment that suits you</span>
                            </p>
                            <button class="submitBtn rounded-pill fw-bold">Start Searching</button>
                        </div>
                    </div>
                    <div id="banner-right" class="col-lg-6 col-md-8 col-sm-12 text-center p-5">
                        <div class="float-left">
                            <img class="img-fluid" src="{{asset('frontendImg/bannerImg.png')}}" alt="Banner Asset" width="600">
                        </div>
                    </div>
                </div>
            </div>

            <section class="home-top-news d-flex align-items-center justify-content-center" style="min-height: 60vh" id="home-top-news">
                @php
                    $latestNews = App\Models\News::latest()->first();    
                @endphp

                <div class="container" >
                    <div class="card mb-3 border-0 shadow-sm" style="background-color: #EFF6FE;">
                        <div class="row">
                          <div class="col-md-8 p-3">
                            <div class="card-body">
                              <h2 class="badge bg-secondary mb-4 fs-4 fw-light" >{{$latestNews['category']['newsCategory']}}</h2>
                              <a href="{{route('news.detail', $latestNews->id)}}" class="text-decoration-0">
                                  <p class="card-title fs-1 news-title mb-4">{{$latestNews->newsTitle}}</p>
                              </a>
                              <p class="card-text"><small class="text-body-secondary">Published {{Carbon\Carbon::parse($latestNews->created_at)->diffForHumans()}} </small></p>
                              <p class="card-text">By: {{$latestNews->newsAuthor}}</p>
                              <a href="#">See More >></a>
                            </div>
                          </div>
                          <div class="col-md-4 d-flex align-items-center p-4">
                            <a href="{{route('news.detail', $latestNews->id)}}">
                                <img src="{{asset($latestNews->newsImage)}}" class=" w-100 img-fluid rounded" alt="...">
                            </a>
                          </div>
                        </div>
                      </div>
                </div>
            </section>

            <section class="home-top-franchise" id="home-top-franchise">
                <div class="container p-4">
                    <div class="row mt-4">
                        <div class="col-lg-8 col-md-12 col-sm-12 align-self-start">
                            <p class="section-label">FranchiseKu Top Franchises</p>
                            <h1 class="top-franchise-title text-lg">Several Categories Top Franchises</h1>
                        </div>
                    </div>

                    <div class="row mt-4">
                        <div class="col align-self-center">
                            <div class="buttonGroup d-grid gap-2 d-md-block">
                                 <button class="btn btn-primary border active">Food Franchise</button> 
                                 <button class="btn btn-light border">Cosmetics</button> 
                                 <button class="btn btn-light border">Supplements</button> 
                            </div>
                        </div>
                    </div>

                    <div class="row mt-4 mb-4">
                        <div class="col top-franchise-text align-self-end">
                            <p class="mb-4"><span > Fortunes come to people that takes the chance and effort to get the opportunity. FranchiseKu offers platform that enables user to connect with franchises they desire and help users to know and improve their financial literacy </span></p>
                            <p>To quickly start, user can click on several top franchises below to see some of our top recommendations or go to our franchise list page to see the whole selections FranchiseKu has to offer, user could also search franchise investment according to their preference and desire</p>
                        </div>
                    </div>

                    <div class="row mb-4">
                        <div class="col-md-4 mb-3">
                            <div class="card border-0 shadow-sm bg-light p-2">
                                <a href="#">
                                    <img src="{{asset('upload/franchise/cafe1.jpeg')}}" class="card-img-top rounded" alt="...">
                                </a>
                                <div class="card-body">
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-0 bg-light p-2 shadow-sm">
                                <a href="#">
                                    <img src="{{asset('upload/franchise/cafe1.jpeg')}}" class="card-img-top rounded" alt="...">
                                </a>
                                <div class="card-body">
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                              </div>
                        </div>
                        <div class="col-md-4 mb-3">
                            <div class="card border-0 bg-light p-2 shadow-sm">
                                <a href="#">
                                    <img src="{{asset('upload/franchise/cafe1.jpeg')}}" class="card-img-top rounded" alt="...">
                                </a>
                                <div class="card-body">
                                  <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's content.</p>
                                </div>
                              </div>
                        </div>
                    </div>

                    <div class="row mt-4 text-center">
                        <a href="text-secondary">
                            <p>click on the franchises above to see more details >> </p>
                        </a>
                    </div>

                </div>
            </section>

            <section id="home-subscription" class="home-subscription">
                <div class="container-fluid bg-white p-2 d-flex align-items-center" style="min-height: 100vh;" >
                    <div class="row ">
                        <div class="col-md-5 d-flex align-items-center p-4 mb-4">
                            <img class="home-subscription-img img-fluid" alt="" src="{{asset('upload/home-asset/home-subscription-img.png')}}">
                        </div>
                        {{-- <div class="col-md-2"></div> --}}
                        <div class="col-md-6 home-subscription-content mx-auto">
                            <div class="row">
                                <div class="col">
                                    <p class="text-info">Data Poweredd, Real-time information</p>
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col">
                                    <h1 class="fs-2">Learn and Educate Yourself!!</h1>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <p>Open your horizon and learn new knowledge to forge your future, using our well structured education courses suited for you.</p>
                                <p class="fs-5 fw-bold"><a href="" style="color: #1F384F;">get started now.</a></p>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-2 col-sm-2 p-4">
                                    <img src="{{asset('upload/home-asset/feedback-bg.png')}}" class="img-fluid" alt="asd">
                                </div>
                                <div class="col-md-8 col-sm-8">
                                    <p class="fs-5">Easy Filter Usage</p>
                                    <p>Secure the type of course you want to look at your list</p>
                                </div>
                            </div>
                            <div class="row mb-4">
                                <div class="col-md-2 col-sm-2 p-4">
                                    <img src="{{asset('upload/home-asset/feedback-bg.png')}}" class="img-fluid mx-auto d-block" alt="asd">
                                </div>
                                <div class="col-md-8">
                                    <p class="fs-5">Easy Information Transparency</p>
                                    <p>Every courses equipped with detailed information</p>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <a href="">
                                        <button type="button" class="submitBtn" style="background-color: #0070F0">Start Now</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            <section id="contact-us" class="contact-us d-flex justify-content-center align-items-center  " style="min-height: 60vh">
                <div class="container">
                    <div class="rounded text-center contact-us-div m-auto col-sm-12 col-md-12">
                        <div class="row p-2">
                            <h1 class="text-lg">Need Help Making a Decision ?</h1>
                        </div>
                        <div class="row">
                            <a href="" class="text-decoration-none">
                                <button class="submitBtn" style="margin: 2rem auto;">Send Message to Admin</button>
                            </a>
                        </div>
            
                        <div class="row">
                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items">
                                <span class="material-symbols-outlined">task_alt</span>
                                <p class="text-sm">Ask things you need and the product that matters to you</p>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items">
                                <span class="material-symbols-outlined">task_alt</span>
                                <p class="text-sm">Learn how FranciseKu could find the best product for you</p>
                            </div>
                            <div class="col-lg-4 col-md-6 col-sm-12 d-flex align-items">
                                <span class="material-symbols-outlined">task_alt</span>
                                <p class="text-sm">Get Top notch support from our team in every step of the application process</p>
                            </div>
                        </div>
                    </div>
                </div>
            </section>

            @include('components.register_franchisor');
            @include('modals.success-modal');
            
            @include('components.footer')
    </body>

      {{-- Toaster --}}
      <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
      <script>
          @if(Session::has('message'))
          var type = "{{ Session::get('alert-type','info') }}"
          switch(type){
             case 'info':
             toastr.info(" {{ Session::get('message') }} ");
             break; 
         
             case 'success':
             toastr.success(" {{ Session::get('message') }} ");
             break;
         
             case 'warning':
             toastr.warning(" {{ Session::get('message') }} ");
             break;
         
             case 'error':
             toastr.error(" {{ Session::get('message') }} ");
             break; 
          }
          @endif 
         </script>

      
</html>
