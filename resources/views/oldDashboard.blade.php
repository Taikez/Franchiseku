@extends('layouts.app')

@section('main')
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
                    <button class="submitBtn rounded-pill fw-bold" data-aos="flip-right" data-aos-duration="800">Start
                        Searching</button>
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
        @php
            $latestNews = App\Models\News::latest()->first();
        @endphp

        <div class="container">
            <div class="card mb-3 border-0 shadow-sm" style="background-color: #EFF6FE;" data-aos="zoom-in"
                data-aos-duration="800">
                <div class="row">
                    <div class="col-md-8 p-3">
                        <div class="card-body">
                            <h2 class="badge bg-secondary mb-4 fs-4 fw-light">
                                {{ $latestNews['category']['newsCategory'] }}</h2>
                            <a href="{{ route('news.detail', $latestNews->id) }}" class="text-decoration-0">
                                <p class="card-title fs-1 fw-light news-title mb-4">{{ $latestNews->newsTitle }}</p>
                            </a>
                            <p class="card-text"><small class="text-body-secondary">Published
                                    {{ Carbon\Carbon::parse($latestNews->created_at)->diffForHumans() }} </small></p>
                            <p class="card-text">By: {{ $latestNews->newsAuthor }}</p>
                            <a href="#">See More >></a>

                        </div>
                    </div>
                    <div class="col-md-4 d-flex align-items-center p-4">
                        <a href="{{ route('news.detail', $latestNews->id) }}">
                            <img src="{{ asset($latestNews->newsImage) }}" class=" w-100 img-fluid rounded" alt="...">
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
                    <p class="section-label" data-aos="fade-down-right" data-aos-duration="800">FranchiseKu Top
                        Franchises</p>
                    <h1 class="top-franchise-title text-lg" data-aos="fade-right" data-aos-duration="800">Several
                        Categories Top Franchises</h1>
                </div>
            </div>

            <div class="row mt-4">
                @if ($franchiseCategories->count() == 0)
                    <div class="col-lg-3 pb-3" data-aos="fade-down-right" data-aos-duration="800">
                        <div class="alert alert-warning w-100">No franchise categories to be found!</div>
                    </div>
                @else
                    <div class="col align-self-center">
                        <div class="buttonGroup d-grid gap-2 d-md-block">
                            @foreach ($franchiseCategories as $franchiseCategory)
                                <button class="btn btn-light border" data-aos="fade-up"
                                    data-aos-duration="800">{{ $franchiseCategory->franchiseCategory }}</button>
                            @endforeach
                        </div>
                    </div>
                @endif
            </div>

            <div class="row mt-4 mb-4">
                <div class="col top-franchise-text align-self-end">
                    <p class="mb-4" data-aos="fade-left" data-aos-duration="800"><span> Fortunes come to people
                            that takes the chance and effort to get the
                            opportunity. FranchiseKu offers platform that enables user to connect with franchises they
                            desire and help users to know and improve their financial literacy </span></p>
                    <p data-aos="fade-right" data-aos-duration="800">To quickly start, user can click on several top
                        franchises below to see some of our top
                        recommendations or go to our franchise list page to see the whole selections FranchiseKu has to
                        offer, user could also search franchise investment according to their preference and desire</p>
                </div>
            </div>
            @if ($franchises->count() == 0)
                <div class="col-lg-12 pb-3" data-aos="fade-down-right" data-aos-duration="800">
                    <div class="alert alert-warning w-100">No franchises to be found!</div>
                </div>
            @else
                <div class="row mb-4">
                    @foreach ($franchises as $franchise)
                        <div class="col-lg-4 col-md-6 col-sm-9 mb-3" data-aos="fade-down-left" data-aos-duration="1000">
                            <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                style="overflow: hidden">
                                <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                    <img src="{{ asset($franchise->franchiseLogo) }}" alt="Education Content Banner"
                                        class="img-fluid w-100" style="object-fit: cover; height: 100%; width: 100%;">
                                </div>
                                <div class="p-3">
                                    <h3>{{ $franchise->franchiseName }}</h3>
                                    <p class="mb-2 text-muted">By {{ $franchise->franchisePIC }}</p>
                                    <span class="badge bg-info mb-3">
                                        {{ $franchise->franchiseCategory }}
                                    </span>
                                    <p class="mb-2">IDR {{ number_format($franchise->franchisePrice, 2) }}</p>
                                    <hr>
                                    <a href="{{ route('education.detail', $franchise->id) }}"
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
                <div class="col-md-5 d-flex align-items-center p-4 mb-4" data-aos="flip-left" data-aos-duration="800">
                    <img class="home-subscription-img img-fluid" alt=""
                        src="{{ asset('upload/home-asset/home-subscription-img.png') }}">
                </div>
                <div class="col-md-6 home-subscription-content mx-auto">
                    <div data-aos="fade-left" data-aos-duration="800">
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
                    <p class="fs-5 fw-bold" data-aos="fade-up-left" data-aos-duration="800"><a href=""
                            style="color: #1F384F;">get started now.</a>
                    </p>
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

    {{-- <section id="contact-us" class="contact-us d-flex justify-content-center align-items-center  " style="min-height: 60vh">
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
            </section> --}}

    <section id="contact-us" class="contact-us" style="min-height: 60vh">
        <div class="container mt-5 mb-5 p-4 rounded contact-us-div" data-aos="fade-right" data-aos-duration="800">
            <div class="row d-flex align-items-center">
                <div class="col-md-6 mx-auto d-flex flex-column justify-content-between p-4" style="height: 35vh;">
                    <h1 class="fs-3 fw-normal text-light" data-aos="fade-down-right" data-aos-duration="800">Have a
                        question or need assistance? Reach Out to Our Admin
                        Team</h1>
                    <p class="fs-5 fw-light" data-aos="fade-up-right" data-aos-duration="800">Your inquiries are
                        important to us, and we're here to help. Send us a
                        message today!"</p>
                </div>

                <div class="col-md-6" data-aos="fade-left" data-aos-duration="800">
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name">
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control" name="message" id="message" cols="30" rows="5"></textarea>
                        </div>
                        <div class="mb-3 mt-4 d-flex justify-content-end">
                            <button type="submit" class="submitBtn fs-5"
                                style="padding: .25rem 1rem; border-radius:5px;" data-aos="zoom-in"
                                data-aos-duration="800">Send Message</button>
                        </div>
                    </form>
                </div>
                <div class="col-md-6"></div>
            </div>
        </div>

    </section>
    </body>
@endsection


@include('modals.success-modal');
</body>

{{-- Toaster --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
<script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
<script>
    AOS.init();
</script>
<script>
    @if (Session::has('message'))
        var type = "{{ Session::get('alert-type', 'info') }}"
        switch (type) {
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
