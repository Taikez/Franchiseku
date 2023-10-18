@extends('layouts.app')

@section('main')
    @vite('resources/css/education.css')
    @vite('resources/js/education.js')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-5">
                <h1 class="text-center fw-bold">Education Content Spread</h1>
                <p class="text-center text-secondary mb-4">You can learn something new everyday!</p>
                <div class="container-fluid w-100">
                    <img src="{{ asset('frontendImg/educationContentBanner.png') }}" alt="Education Content Banner"
                        class="img-fluid w-100">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 px-3">
                <form action="{{ route('searchEducationContent') }}" class="col-md-12" method="POST">
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
            <div id="education-vertical-menu" class="col-lg-3 col-md-3 col-sm-3">
                @include('components.education-sidebar')
            </div>
            @if ($educations->count() == 0)
                <div class="col-lg-9 pb-3">
                    <div class="alert alert-warning w-100">No education content to be found!</div>
                </div>
            @else
                <div class="col-lg-9 pb-3">
                    <div class="row">
                        @foreach ($educations as $education)
                            <div class="col-lg-4 col-md-6 col-sm-9 mb-3">
                                <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                    style="overflow: hidden">
                                    <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                        <img src="{{ asset('frontendImg/educationContentBanner.png') }}"
                                            alt="Education Content Banner" class="img-fluid w-100"
                                            style="object-fit: cover; height: 100%; width: 100%;">
                                    </div>
                                    <div class="p-3">
                                        <h3>{{ $education->title }}</h3>
                                        <p class="mb-2 text-muted">By {{ $education->user->name }}</p>
                                        <span class="badge bg-info mb-3">
                                            {{ $education->educationCategory->educationCategory }}
                                        </span>
                                        <p class="mb-2">IDR {{ number_format($education->price, 2) }}</p>
                                        <p class="mb-2 text-muted" style="font-size: 12px;">{{ $education->description }}
                                        </p>
                                        <hr>
                                        <a href="" class="d-flex justify-content-between">
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
                </div>
            @endif
        </div>
        <div class="col-lg-9 px-3 pb-3 w-100">
            @include('components.register_franchisor')
        </div>
    </div>
@endsection
