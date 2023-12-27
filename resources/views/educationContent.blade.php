@extends('layouts.app')

@section('title')
    Education | FranchiseKu
@endsection

@section('main')
    @vite('resources/css/education.css')
    @vite('resources/js/education.js')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-5">
                <h1 class="text-center fw-bold" data-aos="fade" data-aos-duration="800">Education Content Spread</h1>
                <p class="text-center text-secondary mb-4" data-aos="fade" data-aos-duration="800">You can learn
                    something new everyday!</p>
                <div class="container-fluid w-100" data-aos="fade" data-aos-duration="800">
                    <img src="{{ asset('frontendImg/educationContentBanner.png') }}" alt="Education Content Banner"
                        class="img-fluid w-100">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 px-3">
                <form action="{{ route('education.search') }}" class="col-md-12" method="POST">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text h-100 border-start border-top border-bottom bg-white"><i
                                    class="fa fa-search"></i></span>
                        </div>
                        <input type="text" id="search-content" class="form-control border-1 bg-white"
                            placeholder="Search content here ..." name="searchValue">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @include('components.education-sidebar')
            @if ($educations->count() == 0)
                <div class="col-lg-9 pb-3" data-aos="fade" data-aos-duration="800">
                    <div class="alert alert-warning w-100">No education content to be found!</div>
                </div>
            @else
                <div class="col-lg-9 pb-3">
                    <div class="row mb-3">
                        @foreach ($educations as $education)
                            <div class="col-lg-4 col-md-6 col-sm-9 mb-3" data-aos="fade" data-aos-duration="1000">
                                <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                    style="overflow: hidden">
                                    <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                        <img src="{{ asset($education->educationThumbnail) }}"
                                            alt="Education Content Banner" class="img-fluid w-100"
                                            style="object-fit: cover; height: 100%; width: 100%;">
                                    </div>
                                    <div class="p-3">
                                        <h3>{{ $education->educationTitle }}</h3>
                                        <p class="mb-2 text-muted">By {{ $education->educationAuthor }}</p>
                                        @if ($education->educationRating != null)
                                            <div class="d-flex align-items-end">
                                                @for ($i = 1; $i <= $education->educationRating; $i++)
                                                    <div id="star" class="fs-3 fw-bold text-warning">★ </div>
                                                @endfor
                                                <p style="margin-bottom: 6px;">({{ $education->educationRating }})</p>
                                            </div>
                                        @endif
                                        <span class="badge bg-info mb-3">
                                            {{ $education->category->educationCategory }}
                                        </span>
                                        <p class="mb-2">IDR {{ number_format($education->educationPrice, 2) }}</p>
                                        <p class="mb-2 text-muted" style="font-size: 12px;">
                                            {{ $education->educationShortDesc }}
                                        </p>
                                        <hr>
                                        <a href="{{ route('education.detail', $education->id) }}"
                                            class="d-flex justify-content-between">
                                            <div>
                                                View Content
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
                    <div class="d-flex justify-content-center">
                        <div class="btn btn-primary mt-3" data-aos="fade" data-aos-duration="800">
                            <a href="{{ route('education.all') }}">Browse
                                All
                                Content</a>
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
