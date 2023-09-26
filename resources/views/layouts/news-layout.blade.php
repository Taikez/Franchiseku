<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ config('app.name', 'FranchiseKu') }}</title>
        
         <!-- Fonts -->
         <link rel="preconnect" href="https://fonts.bunny.net">
         <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
           <link href="https://fonts.googleapis.com/css2?family=EB+Garamond:wght@400;500;600;700;800&family=Poppins:wght@100;200;300;400;500;600;700;800&family=Roboto:wght@100;300;500;700;900&display=swap" rel="stylesheet">
           <link rel="preconnect" href="https://fonts.googleapis.com">
           <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

        <link rel="stylesheet" href="{{asset('css/auth.css')}}">

        @vite('resources/css/blog.css')

        <!-- Bootstrap Css -->
        {{-- <link href="{{asset('backend/assets/css/bootstrap.min.css')}}" id="bootstrap-style" rel="stylesheet" type="text/css" /> --}}

        <!-- Scripts -->
        @vite(['resources/css/app.css','resources/css/header.css', 'resources/js/app.js', 'resources/sass/app.scss'])

        {{-- icon --}}
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@48,400,0,0" />
        <link rel="stylesheet" href="{{asset('frontend/assets/css/fontawesome-all.min.css')}}">
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100">
            @include('layouts.guest_header')

            @vite('resources/css/auth.css')
            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            
<div id="newsTitle">
    <div class="container-fluid  d-flex align-items-center justify-content-center" style="min-height: 50vh">
        <div class="row">
            <div class="col">
                <div class="row text-center gap-4">
                    <h1 class="fs-1 fw-bold" >Today Business News</h1>
                    <p class="fs-5">See What’s Happening In The World Today</p>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="news bg-white" id="newsBody">
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-4">
              <aside class="blog__sidebar">
                 
                  <div class="widget">
                      <h4 class="widget-title">Recent Blog</h4>
                      <ul class="rc__post">
                          @foreach ($latestNews as $item)
                              <li class="rc__post__item">
                                  <div class="rc__post__thumb">
                                      <a href=""><img class="img-fluid " src="{{asset($item->newsImage)}}" alt=""></a>
                                  </div>
                                  <div class="rc__post__content">
                                      <h5 class="title"><a href="">{{$item->newsTitle}}</a></h5>
                                          <span class="post-date"><i class="fal fa-calendar-alt"></i> {{Carbon\Carbon::parse($item->created_at)->diffForHumans()}} </span>
                                    </div>
                              </li>
                          @endforeach
                      </ul>
                  </div>
                  <div class="widget">
                      <h4 class="widget-title">Categories</h4>
                      <ul class="sidebar__cat">
                          @foreach ($categories as $item)
                        <li class="sidebar__cat__item w-75">
                            <a href="">{{$item->newsCategory}}</a>
                        </li>
                          @endforeach
                      </ul>
                  </div>
                 
                  <div class="widget">
                      <h4 class="widget-title">Popular Tags</h4>
                      <ul class="sidebar__tags">
                          <li><a href="blog.html">Business</a></li>
                          <li><a href="blog.html">Design</a></li>
                          <li><a href="blog.html">apps</a></li>
                          <li><a href="blog.html">landing page</a></li>
                          <li><a href="blog.html">data</a></li>
                          <li><a href="blog.html">website</a></li>
                          <li><a href="blog.html">book</a></li>
                          <li><a href="blog.html">Design</a></li>
                          <li><a href="blog.html">product design</a></li>
                          <li><a href="blog.html">landing page</a></li>
                          <li><a href="blog.html">data</a></li>
                      </ul>
                  </div>
              </aside>
            </div>
            <div class="col rightPanel" style="min-height: 100vh" id="newsContent">
              <!-- Page Content -->
              @yield('main') <!-- This is where the content will be injected -->
              
            </div>
        </div>
    </div>
</div>
        </div>
    </body>
</html>

<script>
    var baseUrl = "{{ asset('') }}";
</script>