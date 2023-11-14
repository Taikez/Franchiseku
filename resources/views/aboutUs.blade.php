@extends('layouts.app')
@section('title')
    About Us Page | FranchiseKu
@endsection

@section('main')
    <div id="header" class="container-fluid mb-5">
        <div class="row">
            <div id="header-left" class="col-lg-6 col-md-6 col-sm-12 p-5 d-flex align-items-center">
                <div id="extra-padding" class="p-5" style="margin-left: 10rem;">
                    <h1 class="mb-5 fw-bolder" style="font-size: 55px;" data-aos="fade-down-right" data-aos-duration="800">
                        About <br> FranchiseKu</h1>
                    <div id="header-text" class="w-75">
                        <p class="fs-5 lh-base" data-aos="fade-left" data-aos-duration="800">Who are we? welcome to
                            FranchiseKu, the premier franchise investment app
                            designed to help you make well-knowledged decisions about your financial future.</p>

                        <p class="fs-5 lh-base" data-aos="fade-right" data-aos-duration="800">Our platform is built with the
                            latest technology and investment insights to
                            provide you with all the information you need to make sound investment decisions</p>
                    </div>
                </div>
            </div>
            <div id="header-right" class="col-lg-6 col-md-6 col-sm-12 p-5 d-flex align-items-center justify-content-center"
                data-aos="fade-down-left" data-aos-duration="800">
                <img class="img-fluid" src="{{ asset('aboutUsImages/bannerImage.png') }}" alt="Banner Asset" width="600">
            </div>
        </div>
    </div>


    <div id="our-products" class="container-fluid mt-5"
        style="background-color: #FAFBFC; padding-top: 2rem; padding-bottom: 2rem;">
        <div id="our-products-text" class="row d-flex justify-content-center align-items-center text-center mt-5">
            <h1 class="fw-bolder p-5 mt-5" data-aos="fade-down" data-aos-duration="800">Our Products</h1>
        </div>

        <div id="offers" class="row d-flex justify-content-center align-items-center p-5 me-5 lh-lg">
            <div id="offer-1" class="col-lg-4 col-md-12 col-sm-12 text-center" data-aos="fade-up-right"
                data-aos-duration="800">
                <img class="img-fluid mb-4" src="{{ asset('aboutUsImages/offer1.png') }}" alt="Banner Asset" width="32">
                <h3 class="fw-bold">Well Engineered Business News</h3>
                <p class="d-flex justify-content-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat
                    nibh tristique ipsum.</p>
            </div>
            <div id="offer-2" class="col-lg-4 col-md-12 col-sm-12 text-center" data-aos="fade-up" data-aos-duration="800">
                <img class="img-fluid mb-4" src="{{ asset('aboutUsImages/offer2.png') }}" alt="Banner Asset" width="32">
                <h3 class="fw-bold">Diverse Franchise Selection</h3>
                <p class="d-flex justify-content-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat
                    nibh tristique ipsum.</p>
            </div>
            <div id="offer-3" class="col-lg-4 col-md-12 col-sm-12 text-center" data-aos="fade-up-left"
                data-aos-duration="800">
                <img class="img-fluid mb-4" src="{{ asset('aboutUsImages/offer3.png') }}" alt="Banner Asset" width="32">
                <h3 class="fw-bold">Custom course Allocated for you</h3>
                <p class="d-flex justify-content-center">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed erat
                    nibh tristique ipsum.</p>
            </div>
        </div>
    </div>

    @include('components.register_franchisor');
    @include('modals.success-modal');
@endsection
