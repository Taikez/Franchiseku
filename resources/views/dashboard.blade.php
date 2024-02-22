@extends('layouts.app')

@section('title')
    Dashboard | FranchiseKu
@endsection

@section('main')
    {{-- @include('modals.success-modal') --}}
    <div id="banner" class="container-fluid p-5 p-md-5 mb-5">
        <div class="row d-flex align-items-center justify-content-center mb-5">
            <div id="banner-left" class="col-lg-6 col-md-8 col-sm-12 p-2">
                <div class="float-right">
                    <h1 id="banner-title" class="fw-bold mb-4" style="color:#015051;" data-aos="fade-down-right"
                        data-aos-duration="800">Organize your money investment
                    </h1>
                    <p style="font-size: 20px" data-aos="fade-right" data-aos-duration="800">
                        We will help you organize, learn and <br>
                        <span class="fw-bold" style="color: #015051; font-size: 20px">Look for an investment that suits
                            you</span>
                    </p>
                    <a href="{{ route('franchise') }}" class="btn btn-lg btn-success rounded-pill fw-bold px-4"
                        data-aos="flip-right" data-aos-duration="800">Start
                        Searching</a>
                </div>
            </div>
            <div id="banner-right" class="col-lg-6 col-md-8 col-sm-12 text-center p-5" data-aos="fade-down-left"
                data-aos-duration="800">
                <div class="float-left">
                    <img class="img-fluid" src="{{ asset('frontendImg/bannerImg.png') }}" alt="Banner Asset" width="600">
                </div>
            </div>
        </div>
    </div>

    <section class="home-top-news d-flex align-items-center justify-content-center" style="min-height: 60vh"
        id="home-top-news">
        <div class="container">
            @if (is_null($latestNews))
                <div class="col-12" data-aos="fade" data-aos-duration="800">
                    <div class="alert alert-warning w-100">No news to be found!</div>
                </div>
            @else
                <a href="{{ route('news.detail', $latestNews->id) }}">
                    <div class="card mb-3 border-0 shadow-sm rounded" style="background-color: #EFF6FE;" data-aos="fade"
                        data-aos-duration="800">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="d-flex flex-column p-5">
                                    <a href="{{ route('news.detail', $latestNews->id) }}" class="text-decoration-0">
                                        <h1 class="card-title fs-1 fw-bold news-title">{{ $latestNews->newsTitle }}
                                        </h1>
                                    </a>
                                    <h2 class="badge bg-secondary mb-5 fs-6 w-25">
                                        {{ $latestNews['category']['newsCategory'] }}</h2>
                                    <p class="card-text">By {{ $latestNews->newsAuthor }}</p>
                                    <p class="card-text"><small class="text-body-secondary">Published
                                            {{ Carbon\Carbon::parse($latestNews->created_at)->diffForHumans() }} </small>
                                    </p>
                                    <div class="mb-5 w-100">
                                        <a href="{{ route('news.detail', $latestNews->id) }}"
                                            class="btn btn-lg btn-success text-white fw-bold w-100">
                                            Read This Article
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-7 p-5">
                                <img src="{{ asset($latestNews->newsImage) }}" class=" w-100 img-fluid rounded"
                                    alt="...">

                            </div>
                        </div>
                    </div>
                </a>
            @endif
        </div>
    </section>

    <section class="home-top-franchise" id="home-top-franchise">
        <div class="container p-4">
            <div class="row mt-4">
                <div class="col-lg-8 col-md-12 col-sm-12 align-self-start">
                    <p class="section-label">FranchiseKu Top
                        Franchises</p>
                    <h1 class="top-franchise-title text-lg">Several
                        Categories Top Franchises</h1>
                </div>
            </div>

            <div class="row mt-4">
                @if ($franchiseCategories->count() == 0)
                    <div class="col-3 pb-3" data-aos="fade" data-aos-duration="800">
                        <div class="alert alert-warning w-100">No franchise categories to be found!</div>
                    </div>
                @else
                    <div class="col align-self-center">
                        <div class="buttonGroup d-grid gap-2 d-md-block">
                            @foreach ($franchiseCategories as $franchiseCategory)
                                <a href="{{ route('dashboard', ['category' => $franchiseCategory->id] + request()->except('category')) }}"
                                    id="franchise-category-btn-{{ $franchiseCategory->id }}"
                                    class="franchise-category-btn btn btn-light border rounded-pill" data-aos="fade-right"
                                    style="padding: 0.75rem 5rem;"
                                    data-aos-duration="800">{{ $franchiseCategory->franchiseCategory }}</a>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-4 mb-4">
                <div class="col top-franchise-text align-self-end">
                    <h4 class="mb-4">Fortunes come to people
                        that takes the chance and effort to get the
                        opportunity. FranchiseKu offers platform that enables user to connect with franchises they
                        desire and help users to know and improve their financial literacy</h5>
                        <p>To quickly start, user can click on several top
                            franchises below to see some of our top
                            recommendations or go to our franchise list page to see the whole selections FranchiseKu has to
                            offer, user could also search franchise investment according to their preference and desire</p>
                </div>
            </div>
            @if ($franchises->count() == 0)
                <div class="col-lg-12 pb-3" data-aos="fade" data-aos-duration="800">
                    <div class="alert alert-warning w-100">No franchises to be found!</div>
                </div>
            @else
                <div class="row mb-4">
                    @foreach ($franchises as $franchise)
                        <div class="col-lg-3 col-md-6 col-sm-9 mb-3" data-aos="fade" data-aos-duration="1000">
                            <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                style="overflow: hidden">
                                <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                    <img src="{{ asset($franchise->franchiseLogo) }}" alt="Franchise Logo"
                                        class="img-fluid w-100" style="object-fit: cover; height: 100%; width: 100%;">
                                </div>
                                <div class="p-3">
                                    <h3>{{ $franchise->franchiseName }}</h3>
                                    <p class="mb-2 text-muted">By {{ $franchise->franchisePICName }}</p>
                                    <span class="badge bg-info mb-3">
                                        {{ $franchise->franchiseCategory }}
                                    </span>
                                    <p class="mb-2">IDR {{ number_format($franchise->franchisePrice, 2) }}</p>
                                    <hr>
                                    <a href="{{ route('franchise.detail', $franchise->id) }}"
                                        class="d-flex justify-content-between">
                                        <div>
                                            Read More
                                        </div>
                                        <div>
                                            <span class="material-symbols-rounded">
                                                north_east
                                            </span>
                                        </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </section>

    <section id="home-subscription" class="home-subscription">
        <div class="container-fluid bg-white p-2 d-flex align-items-center" style="min-height: 100vh;">
            <div class="row ">
                <div class="col-md-5 d-flex align-items-center p-4 mb-4" data-aos="fade" data-aos-duration="800">
                    <img class="home-subscription-img img-fluid" alt=""
                        src="{{ asset('upload/home-asset/home-subscription-img.png') }}">
                </div>
                <div class="col-md-6 home-subscription-content mx-auto">
                    <div>
                        <div class="row">
                            <div class="col">
                                <p class="text-info">Data Powered, Real-time
                                    information</p>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="col">
                                <h1 class="fs-2">Learn and Educate Yourself!!</h1>
                            </div>
                        </div>
                        <div class="row mb-4">
                            <p>Open your horizon and learn new knowledge to forge your future, using our well structured
                                education courses suited for you.</p>
                        </div>
                    </div>
                    <div class="row mb-4" data-aos="fade-down-right" data-aos-duration="800">
                        <div class="col-md-2 col-sm-2 p-4">
                            <img src="{{ asset('upload/home-asset/feedback-bg.png') }}" class="img-fluid"
                                alt="asd">
                        </div>
                        <div class="col-md-8 col-sm-8">
                            <p class="fs-5">Easy Filter Usage</p>
                            <p>Secure the type of course you want to look at your list</p>
                        </div>
                    </div>
                    <div class="row mb-4" data-aos="fade-up-left" data-aos-duration="800">
                        <div class="col-md-2 col-sm-2 p-4">
                            <img src="{{ asset('upload/home-asset/feedback-bg.png') }}" class="img-fluid mx-auto d-block"
                                alt="asd">
                        </div>
                        <div class="col-md-8">
                            <p class="fs-5">Easy Information Transparency</p>
                            <p>Every courses equipped with detailed information</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col">
                            <a href="{{ route('education.index') }}" data-aos="zoom-in-down" data-aos-duration="800">
                                <button type="button" class="submitBtn" style="background-color: #0070F0">Start
                                    Now</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section id="contact-us" class="contact-us" style="min-height: 60vh" data-aos="fade-up-left"
        data-aos-duration="800">
        <div id="contact-us-scroll" class="container mt-5 mb-5 p-4 rounded contact-us-div">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 mx-auto d-flex flex-column justify-content-between p-4" style="height: 35vh;">
                    <h1 class="fs-3 fw-normal text-light">Have a
                        question or need assistance? Reach Out to Our Admin
                        Team</h1>
                    <p class="fs-5 fw-light">Your inquiries are
                        important to us, and we're here to help. Send us a
                        message today!</p>
                </div>

                <div class="col-md-6">
                    <form action="{{ route('send.email') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name"
                                value="{{ old('name') }}">
                            @error('name')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                aria-describedby="emailHelp" value="{{ old('email') }}">
                            @error('email')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="5"
                                value="{{ old('message') }}"></textarea>
                            @error('message')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3 mt-4 d-flex justify-content-end">
                            <input type="submit" value="Send Message" id="sendEmailBtn" class="submitBtn fs-5"
                                style="padding: .25rem 1rem; border-radius:5px;">
                        </div>
                    </form>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>
    </section>
@endsection
