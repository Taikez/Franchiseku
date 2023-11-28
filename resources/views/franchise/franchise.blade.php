@extends('layouts.app')

@section('title')
    Franchise | FranchiseKu
@endsection

@section('main')
    @vite('resources/css/education.css')
    @vite('resources/js/education.js')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-5">
                <h1 class="text-center fw-bold" data-aos="fade-down" data-aos-duration="800">Franchise List</h1>
                <p class="text-center text-secondary mb-4" data-aos="zoom-in-up" data-aos-duration="800">You can learn
                    something new everyday!</p>
                <div class="container-fluid w-100" data-aos="fade-up-left" data-aos-duration="800">
                    <img src="{{ asset('frontendImg/educationContentBanner.png') }}" alt="Education Content Banner"
                        class="img-fluid w-100">
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 px-3" data-aos="fade-up" data-aos-duration="800">
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
            <div id="education-vertical-menu" class="col-lg-3 col-md-3 col-sm-3">
                @include('components.franchise-sidebar')
            </div>
            @if ($allFranchise->count() == 0)
                <div class="col-lg-9 pb-3" data-aos="fade-down-right" data-aos-duration="800">
                    <div class="alert alert-warning w-100">No education content to be found!</div>
                </div>
            @else
                <div class="col-lg-9 pb-3">
                    <div class="row">
                        @foreach ($allFranchise as $item)
                            <div class="col-lg-4 col-md-6 col-sm-9 mb-3" data-aos="fade-down-left" data-aos-duration="1000">
                                <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                    style="overflow: hidden">
                                    <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                        <img src="{{ asset($item->franchiseLogo) }}"
                                            alt="Education Content Banner" class="img-fluid w-100"
                                            style="object-fit: cover; height: 100%; width: 100%;">
                                    </div>
                                    <div class="p-3">
                                        <h3>{{ $item->franchiseName }}</h3>
                                        <p class="mb-2 text-muted">By {{ $item->franchisePIC }}</p>
                                        <span class="badge bg-info mb-3">
                                            {{ $item->franchiseCategory }}
                                        </span>
                                        <p class="mb-2">IDR {{ number_format($item->franchisePrice, 2) }}</p>
                                        <p class="mb-2 text-muted" style="font-size: 12px;">
                                            {{ $item->educationShortDesc }}
                                        </p>
                                        <hr>
                                        <a href="{{ route('education.detail', $item->id) }}"
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
                </div>
            @endif
        </div>
       
    </div>
@endsection


