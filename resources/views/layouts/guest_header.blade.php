 <!-- Fonts -->
 <link rel="preconnect" href="https://fonts.bunny.net">
 <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
 <link rel="preconnect" href="https://fonts.googleapis.com">
 <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
 <link
     href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800&family=Roboto:wght@100;300;500;700;900&display=swap"
     rel="stylesheet">
 <link rel="stylesheet" href="{{ asset('css/auth.css') }}">

 <!-- Scripts -->
 @vite(['resources/css/app.css', 'resources/js/app.js'])

 <nav class="navbar navbar-expand-lg p-3 sticky-top main-navigation">
     <div class="container-fluid">
         <!-- Navbar brand on the left -->
         {{-- <a href="" class="navbar-brand">FranchiseKu</a> --}}

         <a class="navbar-brand order-2 order-lg-1 mr-auto mr-lg-3 ml-3 ml-lg-0 mx-lg-5"
             href="{{ route('dashboard') }}">
             <img src="{{ asset('authImg/franchiseku_logo.png') }}" alt="FranchiseKu" width="200">
         </a>

         <!-- Toggler button for small screens -->
         <button class="navbar-toggler collapsed" type="button">
             <span class="navbar-toggler-icon"></span>
         </button>

         <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
             <ul class="navbar-nav ml-auto">
                 <!-- Add the "ml-auto" class to move the links to the right -->
                 
                 {{-- Overlay --}}
                 <div class="overlay d-flex d-lg-none text-center"></div>

                 <div class="order-lg-2 d-lg-flex w-50 pb-3 pb-lg-0 sidebar" id="navbarNav">
                     <ul class="navbar-nav mr-lg-auto mb-2 mb-lg-0 text-center">
                         <!-- Add the "ml-auto" class to move the links to the right -->
                         <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle fs-5" href="#" role="button" data-bs-toggle="dropdown"
                         aria-expanded="false">
                         Features
                     </a>
                     <ul class="dropdown-menu">
                         <li><a class="dropdown-item" href="{{ route('news') }}">News</a></li>
                         <li><a class="dropdown-item" href="{{ route('education.index') }}">Education</a></li>
                         <li><a class="dropdown-item" href="{{ route('franchise') }}">Franchises</a></li>
                         @guest
                         @else
                             @if (Auth::user()->role === 'Admin')
                                 <li><a class="dropdown-item" href="{{ route('adminDashboard') }}">Admin Page</a></li>
                             @elseif(Auth::user()->role === 'Franchisor')
                                 <li><a class="dropdown-item" href="{{ route('register.franchise') }}">Add Franchise</a>
                                 </li>
                             @elseif(Auth::user()->role === 'User')
                                 <li><a class="dropdown-item" href="{{ route('register.franchisor') }}">Become Our
                                         Franchisor</a></li>
                             @endif
                         @endguest
                     </ul>
                 </li>

                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle fs-5 px-3 px-lg-2" href="#" role="button"
                                 data-bs-toggle="dropdown" aria-expanded="false">
                                 About
                             </a>
                             <ul class="dropdown-menu">
                                 <li><a class="dropdown-item" href="{{ route('aboutUs') }}">About Us</a></li>
                                 <li><a class="dropdown-item" href="#">Another action</a></li>
                                 <li><a class="dropdown-item" href="#">Something else here</a></li>
                             </ul>
                         </li>

                         <li class="nav-item">
                             <a class="nav-link fs-5 px-3 px-lg-2" href="#">Subscribe</a>
                         </li>

                         @guest
                             <div class="button-group d-flex">
                                 <li class="nav-item">
                                     <a class="btn btn-success header-button border-0 p-2" href="{{ route('login') }}"
                                         type="submit" style="background-color: #3CBA79;">Login</a>
                                 </li>

                                 <li class="nav-item">
                                     <a class="btn btn-info header-button border-0 p-2"
                                         style="background: #4F7097; color:#fafbfc" href="{{ route('register') }}"
                                         type="submit">Register</a>
                                 </li>
                             </div>
                         @else
                             <li class="nav-item dropdown">
                                 <a class="nav-link dropdown-toggle fs-5 d-flex align-items-center px-3 px-lg-2"
                                     href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                                     aria-haspopup="true" aria-expanded="false">
                                     <span class="material-symbols-outlined m-2">person</span>
                                     {{ ucwords(Auth::user()->name) }}
                                 </a>
                                 <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                     <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                                     <a class="dropdown-item" href="">Settings</a>
                                     <div class="dropdown-divider"></div>
                                     <a class="dropdown-item" href="{{ route('logout') }}"
                                         onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                                     <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                         style="display: none;">
                                         @csrf
                                     </form>
                                 </div>
                             </li>
                         @endguest
                     </ul>
                 </div>
         </div>
 </nav>
