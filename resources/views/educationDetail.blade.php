@extends('layouts.app')

@section('main')
    @vite('resources/css/education.css')
    <div class="container-fluid">
        <div class="row">
            <div id="left-content" class="col-lg-7 col-md-7 col-sm-12 p-5">
                <div id="content-title" class="text-center mb-5">
                    <div data-aos="fade-down">
                        <h1 class="fw-bold mb-2" style="color: #015051">{{ $education->educationTitle }}</h1>
                    </div>
                    <h6 class="mb-4" style="color: #015051">Home / Education / Detail</h6>
                    <div class="mb-4" style="width: 25%; height: 3px; background-color: #D9D9D9; margin: auto;"></div>
                </div>
                <div id="content-text" class="px-5">
                    <h5>{!! $education->educationShortDesc !!}</h5>
                    <p class="fw-lighter">{!! $education->educationDesc !!}</p>
                </div>
            </div>

            <div id="right-content" class="col-lg-5 col-md-5 col-sm-12 py-5 px-3">
                <div id="thumbnail-container" class="rounded">
                    <img id="thumbnail" class="img-fluid rounded-3 opacity-50"
                        src="{{ asset($education->educationThumbnail) }}" alt="{{ $education->educationThumbnail }}">
                    <div id="overlay">
                        <span class="material-symbols-rounded fw-light text-black opacity-50" style="font-size: 5rem">
                            lock
                        </span>
                        <h5 class="mt-3 text-black opacity-50">This video is locked</h5>
                    </div>
                </div>
                <div id="content-details">
                    <h6 class="mt-3 fw-light" style="color: #01A7A3">by {{ $education->educationAuthor }} |
                        {{ Carbon\Carbon::parse($education->created_at)->diffForHumans() }}
                    </h6>
                    <h3 class="fw-bold mt-3">Rp {{ number_format($education->educationPrice, 2) }}</h3>
                    <h6 class="fw-light mt-3">Duration: {{ $educationDuration }} minute(s)</h6>
                    <p class="text-muted mt-3">1000 people bought this</p>
                    <div class="text-center">
                        @include('layouts.flashMessage')
                        <div class="row">
                            <button id="purchaseEducationBtn"
                                class="btn w-50 text-white rounded-pill mt-3 mb-2">Purchase</button>
                            @include('modals.rateEducationContentModal')
                            <button type="button" id="rateEducationBtn" class="btn w-50 text-white rounded-pill mt-3 mb-2"
                                data-bs-toggle="modal" data-bs-target="#ratingModal">Rate
                                Content</button>
                        </div>
                        <a href="{{ route('education.index') }}" id="browseMoreContent" class="text-center mt-4">Browse
                            more
                            content</a>
                    </div>
                </div>

                <div id="review-container" class="rounded-3 border border-2 p-3 mt-5" data-aos="fade-right">
                    <div id="review-container-top" class="d-flex justify-content-between align-items-center mb-3">
                        <h4 class="fw-bold text-center">Top Reviews</h4>
                        <div class="mb-4" style="width: 50%; height: 3px; background-color: #D9D9D9; margin: auto;">
                        </div>
                    </div>
                    <div class="d-flex justify-content-between">
                        <div id="review-container-left" class="col-lg-4 col-md-4 col-sm-12">
                            <span class="badge py-2 px-5 rounded-pill" style="background-color: #01A7A3">Top Five</span>
                        </div>
                        <div id="review-container-right" class="col-lg-8 col-md-8 col-sm-12" style="padding-left: 2rem;">
                            <p style="font-size: 12px;">Lorem ipsum dolor sit amet, consectetur adipisicing elit.
                                Dolore,
                                quaerat illo quas facilis
                                praesentium id, perspiciatis explicabo delectus ducimus illum magnam. Doloremque ea
                                dolores
                                consectetur sunt sequi quas, sapiente iste.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div id="other-contents" class="row p-5">
            <h3 class="text-center fw-bold mb-5">You might also like</h3>
            <div class="row">
                @if ($otherEducations->count() == 0)
                    <div class="col-lg-12 pb-3">
                        <div class="alert alert-warning w-100">No education content found!</div>
                    </div>
                @else
                    @foreach ($otherEducations as $otherEducation)
                        <div class="col-lg-4 col-md-6 col-sm-9 mb-3">
                            <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                style="overflow: hidden">
                                <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                    <img src="{{ asset($otherEducation->educationThumbnail) }}"
                                        alt="Education Content Banner" class="img-fluid w-100"
                                        style="object-fit: cover; height: 100%; width: 100%;">
                                </div>
                                <div class="p-3">
                                    <h3>{{ $otherEducation->educationTitle }}</h3>
                                    <p class="mb-2 text-muted">By {{ $otherEducation->educationAuthor }}</p>
                                    <span class="badge bg-info mb-3">
                                        {{ $otherEducation->category->educationCategory }}
                                    </span>
                                    <p class="mb-2">IDR {{ number_format($otherEducation->educationPrice, 2) }}</p>
                                    <p class="mb-2 text-muted" style="font-size: 12px;">\

                                        {{ $otherEducation->educationShortDesc }}
                                    </p>
                                    <hr>
                                    <a href="{{ route('education.detail', $otherEducation->id) }}"
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
