@extends('layouts.app')

@section('main')
    @vite('resources/css/education.css')
    <div class="container-fluid">
        <div class="row">
            <div id="left-content" class="col-lg-7 col-md-7 col-sm-12 p-5">
                <div id="content-title" class="text-center mb-5">
                    <div data-aos="fade-down" data-aos-duration="800">
                        <h1 class="fw-bold mb-2" style="color: #015051">{{ $franchise->franchiseName }}</h1>
                    </div>
                    <div data-aos="fade-up-left" data-aos-duration="800">
                        <h6 class="mb-4" style="color: #015051">Home / Education / Detail</h6>
                        <div class="mb-4" style="width: 25%; height: 3px; background-color: #D9D9D9; margin: auto;"></div>
                    </div>
                </div>
                <div id="content-text" class="px-5" data-aos="fade-right" data-aos-duration="800">
                    <h5>{!! $franchise->educationShortDesc !!}</h5>
                    {{-- <p class="fw-lighter">{!! $franchise->educationDesc !!}</p> --}}
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Tenetur, quo facere qui esse veniam unde debitis? Eveniet delectus impedit quia porro? Porro saepe modi distinctio alias est voluptatibus hic pariatur, earum exercitationem quibusdam sequi! Molestiae laudantium expedita cupiditate explicabo, incidunt aliquid ipsum aut pariatur temporibus voluptatem soluta reprehenderit blanditiis nisi, nemo, laborum porro earum iste repudiandae provident nostrum deleniti. Modi accusamus repellat, ea accusantium aut explicabo doloremque facilis numquam eaque, quam officia est sed odit laboriosam praesentium ratione dolorem pariatur, laborum rem perspiciatis eligendi delectus nesciunt? Officia nihil quod pariatur. Tempora quaerat eveniet dignissimos recusandae laudantium mollitia facere, reprehenderit deserunt?</p>
                </div>
            </div>

            <div id="right-content" class="col-lg-5 col-md-5 col-sm-12 py-5 px-3">
                <div id="thumbnail-container" class="rounded" data-aos="fade-down-left" data-aos-duration="800">
                    <img id="thumbnail" class="img-fluid rounded-3 opacity-50"
                        src="{{ asset($franchise->franchiseLogo) }}" alt="{{ $franchise->franchiseLogo }}">
                    <div id="overlay">
                        <span class="material-symbols-rounded fw-light text-black opacity-50" style="font-size: 5rem">
                            lock
                        </span>
                        <h5 class="mt-3 text-black opacity-50">This video is locked</h5>
                    </div>
                </div>
                <div id="content-details">
                    <h6 class="mt-3 fw-light" style="color: #01A7A3" data-aos="fade-left" data-aos-duration="800">by
                        {{ $franchise->franchisePICName }} |
                        {{ Carbon\Carbon::parse($franchise->created_at)->diffForHumans() }}
                    </h6>
                    <h3 class="fw-bold mt-3" data-aos="fade-right" data-aos-duration="800">Rp
                        {{ number_format($franchise->franchisePrice, 2) }}</h3>
                   
                    <p class="text-muted mt-3" data-aos="fade-right" data-aos-duration="800">1000 people bought this</p>
                    <div class="text-center">
                        @include('layouts.flashMessage')
                        <div class="row">
                            <div data-aos="fade-up-left" data-aos-duration="800">
                                <button id="purchaseEducationBtn" class="btn w-50 text-white rounded-pill mt-3 mb-2"
                                    data-aos="fade-up-right" data-aos-duration="800">Purchase</button>
                            </div>
                            {{-- @include('modals.rateEducationContentModal') --}}
                            <div data-aos="fade-up-right" data-aos-duration="800">
                                <button type="button" id="rateEducationBtn"
                                    class="btn w-50 text-white rounded-pill mt-3 mb-2" data-bs-toggle="modal"
                                    data-bs-target="#ratingModal">Rate
                                    Content</button>
                            </div>
                        </div>
                        <div data-aos="fade-up-left" data-aos-duration="800">
                            <a href="{{ route('franchise') }}" id="browseMoreContent" class="text-center mt-4">Browse
                                more
                                content</a>
                        </div>
                    </div>
                </div>
                @if (count($ratings) > 0)
                    <div id="ratingCarousel" class="carousel slide p-5 d-flex justify-content-center align-items-center"
                        data-bs-ride="carousel" data-aos="fade-down-right" data-aos-duration="800">
                        <div class="carousel-inner">
                            @foreach ($ratings as $rating)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
                                    <div id="review-container" class="rounded-3 border border-2 p-5 mt-5"
                                        data-aos="fade-right" data-aos-duration="800">
                                        <div class="row d-flex justify-content-center mb-3">
                                            <div class="col-lg-6 col-md-6 col-sm-12">
                                                <h4 class="fw-bold">{{ $rating->educationContent->educationTitle }}</h4>
                                                <h6 class="mt-3 fw-light" style="color: #01A7A3">
                                                    Rated by {{ $rating->user->name }} |
                                                    {{ Carbon\Carbon::parse($rating->created_at)->diffForHumans() }}
                                                </h6>
                                            </div>
                                            <div class="col-lg-6 col-md 6 col-sm-12">
                                                <div class="d-flex justify-content-center">
                                                    @for ($i = 1; $i <= $rating->rating; $i++)
                                                        <div id="star" class="px-2 fs-2 fw-bold">★ </div>
                                                    @endfor
                                                </div>
                                            </div>
                                        </div>
                                        <div id="line" class="col-12" style="height: 5px; background-color: #D9D9D9">
                                        </div>
                                        <div class="row">
                                            <div class="col-12 mt-5 lh-lg">
                                                {{ $rating->comment }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#ratingCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon text-primary" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#ratingCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                @else
                    <div class="col-lg-12 pb-3">
                        <div class="alert alert-warning w-100" data-aos="zoom-in-left" data-aos-duration="800">No rating
                            was
                            found for this franchise content!</div>
                    </div>
                @endif
            </div>
        </div>
        <div id="other-contents" class="row p-5">
            <h3 class="text-center fw-bold mb-5" data-aos="fade-down" data-aos-duration="800">You might also like</h3>
            <div class="row">
                @if ($otherFranchise->count() == 0)
                    <div class="col-lg-12 pb-3" data-aos="fade" data-aos-duration="800">
                        <div class="alert alert-warning w-100">No franchise content found!</div>
                    </div>
                @else
                    @foreach ($otherFranchise as $item)
                        <div class="col-lg-4 col-md-6 col-sm-9 mb-3" data-aos="fade-up" data-aos-duration="800">
                            <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                style="overflow: hidden">
                                <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                    <img src="{{ asset($item->educationThumbnail) }}"
                                        alt="Education Content Banner" class="img-fluid w-100"
                                        style="object-fit: cover; height: 100%; width: 100%;">
                                </div>
                                <div class="p-3">
                                    <h3>{{ $item->educationTitle }}</h3>
                                    <p class="mb-2 text-muted">By {{ $item->educationAuthor }}</p>
                                    <span class="badge bg-info mb-3">
                                        {{ $item->category->educationCategory }}
                                    </span>
                                    <p class="mb-2">IDR {{ number_format($item->educationPrice, 2) }}</p>
                                    <p class="mb-2 text-muted" style="font-size: 12px;">\

                                        {{ $item->educationShortDesc }}
                                    </p>
                                    <hr>
                                    <a href="{{ route('franchise.detail', $item->id) }}"
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
                @endif
            </div>
        </div>
    </div>
@endsection
