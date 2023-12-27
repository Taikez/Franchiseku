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

 <nav class="navbar navbar-expand-lg p-3 sticky-top">
     <div class="container-fluid">
         <!-- Navbar brand on the left -->
         <a class="navbar-brand" href="{{ route('dashboard') }}">
             <img src="{{ asset('authImg/franchiseku_logo.png') }}" alt="FranchiseKu" width="200">
         </a>

         <!-- Toggler button for small screens -->
         <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
             aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
             <span class="navbar-toggler-icon"></span>
         </button>
         <div class="collapse navbar-collapse flex-grow-0" id="navbarNav">
             <!-- Add the "ml-auto" class to move the links to the right -->
             <ul class="navbar-nav ml-auto">
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle fs-5 text-start" href="#" id="navbarFeatures"
                         role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside" aria-expanded="false">
                         Features
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarFeatures">
                         <li><a class="dropdown-item" href="{{ route('news') }}">News</a></li>
                         <li><a class="dropdown-item" href="{{ route('education.index') }}">Education Contents</a></li>
                         <li><a class="dropdown-item" href="{{ route('franchise') }}">Franchises</a></li>
                         @guest
                         @else
                             @if (Auth::user()->role === 'Admin')
                                 <li><a class="dropdown-item" href="{{ route('adminDashboard') }}">Admin Page</a></li>
                             @endif
                         @endguest

                     </ul>
                 </li>

                 @guest
                 @else
                     @if (Auth::user()->role === 'Franchisor')
                         <li class="nav-item dropdown">
                             <a class="nav-link dropdown-toggle fs-5 text-start" href="{{ route('franchise') }}"
                                 id="navbarFranchise" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                                 aria-expanded="false">
                                 Franchise
                             </a>
                             <ul class="dropdown-menu" aria-labelledby="navbarFranchise">
                                 <li><a class="dropdown-item" href="{{ route('register.franchise') }}">Add Franchise</a>
                                 </li>
                                 <li><a class="dropdown-item" href="{{ route('my.franchise') }}">My Franchise</a></li>
                                 <li><a class="dropdown-item" href="{{ route('proposal.franchise') }}">Franchise
                                         Proposals</a>
                                 </li>
                         </li>
                 </ul>
                 </li>
                 @endif
             @endguest

             <li class="nav-item">
                 <a class="nav-link fs-5 text-start" href="{{ route('aboutUs') }}">About Us</a>
             </li>

             <li class="nav-item">
                 <a class="nav-link fs-5 text-start" href="#">Subscribe</a>
             </li>

             @guest
                 <div id="loginRegisterBtn" class="button-group d-flex">
                     <li class="nav-item">
                         <a id="loginBtn" class="btn btn-success header-button border-0 p-2" href="{{ route('login') }}"
                             type="submit" style="background-color: #3CBA79;">Login</a>
                     </li>
                     <li class="nav-item">
                         <a id="registerBtn" class="btn btn-info header-button border-0 p-2"
                             style="background: #4F7097; color:#fafbfc" href="{{ route('register') }}"
                             type="submit">Register</a>
                     </li>
                 </div>
             @else
                 @php
                     $user = Auth::user();
                 @endphp
                 <li class="nav-item dropdown">
                     <a class="nav-link dropdown-toggle fs-5 text-start" href="{{ route('franchise') }}"
                         id="navbarFranchise" role="button" data-bs-toggle="dropdown" data-bs-auto-close="outside"
                         aria-expanded="false">
                         History
                     </a>
                     <ul class="dropdown-menu" aria-labelledby="navbarFranchise">
                         <li><a class="dropdown-item" href="{{ route('history.franchise') }}">Franchise History</a>
                         </li>
                         <li><a class="dropdown-item" href="{{ route('history.education') }}">Education Content
                                 History</a>
                         </li>
                     </ul>
                 </li>
                 <li class="nav-item dropdown">
                     <div class="d-flex align-items-center">
                         <div id="profilePicture">
                             @if ($user->profileImage == null || $user->profileImage == '')
                                 <span class="material-symbols-outlined ">person</span>
                             @else
                                 <img class="rounded-circle" style="height:2.5rem; width:2.5rem"
                                     src="{{ asset($user->profileImage) }}" alt="">
                             @endif
                         </div>
                         <a class="nav-link dropdown-toggle fs-5 d-flex align-items-center" href="#"
                             id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true"
                             aria-expanded="false">

                             {{ ucwords(Auth::user()->name) }}
                         </a>
                     </div>
                     <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                         <a class="dropdown-item" href="{{ route('profile.edit') }}">Profile</a>
                         <a class="dropdown-item" href="">Settings</a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="{{ route('logout') }}"
                             onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout</a>
                         <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                             @csrf
                         </form>
                     </div>
                 </li>
             @endguest
             </ul>
         </div>
     </div>
 </nav>
