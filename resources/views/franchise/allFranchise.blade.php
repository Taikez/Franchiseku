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
                <h1 class="text-center fw-bold" data-aos="fade-down" data-aos-duration="800">All Franchises</h1>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 mb-4 px-3">
                <form action="{{ route('franchise.search') }}" class="col-md-12" method="POST">
                    @csrf
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text h-100 border-start border-top border-bottom bg-white"><i
                                    class="fa fa-search"></i></span>
                        </div>
                        <input type="text" id="search-content" class="form-control border-1 bg-white"
                            placeholder="Search franchise here ..." name="searchValue">
                    </div>
                </form>
            </div>
        </div>
        <div class="row">
            @include('components.franchise-sidebar')
            @if ($allFranchise->count() == 0)
                <div class="col-lg-9 pb-3">
                    <div class="alert alert-warning w-100">No franchise found!</div>
                </div>
            @else
                <div class="col-lg-9 pb-3">
                    <div class="row">
                        @foreach ($allFranchise as $item)
                            <div class="col-lg-3 col-md-6 col-sm-9 mb-3" data-aos="fade-down-left" data-aos-duration="1000">
                                <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                                    style="overflow: hidden">
                                    <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                        <img src="{{ asset($item->franchiseLogo) }}" alt="Education Content Banner"
                                            class="img-fluid w-100" style="object-fit: cover; height: 100%; width: 100%;">
                                    </div>
                                    <div class="p-3">
                                        <div class="row">
                                            <div class="col-lg-8 col-md-8 col-sm-12">
                                                <h3>{{ $item->franchiseName }}</h3>
                                            </div>
                                            <div class="col-lg-4 col-md-4 col-sm-12 text-end">
                                                @if ($item->isBought == 1 && Auth::user()->id == $item->boughtBy)
                                                    <span class="badge bg-info mb-3">
                                                        Purchased
                                                    </span>
                                                @else
                                                    <span class="badge bg-success mb-3">
                                                        Available
                                                    </span>
                                                @endif
                                            </div>
                                        </div>
                                        <p class="mb-2 text-muted">By {{ $item->franchisePICName }}</p>
                                        @if ($item->franchiseRating != null)
                                            <div class="d-flex align-items-end">
                                                @for ($i = 1; $i <= $item->franchiseRating; $i++)
                                                    <div id="star" class="fs-3 fw-bold text-warning">★ </div>
                                                @endfor
                                                <p style="margin-bottom: 6px;">({{ $item->franchiseRating }})</p>
                                            </div>
                                        @endif
                                        <span class="badge bg-info mb-3">
                                            {{ $item->franchiseCategory }}
                                        </span>
                                        <p class="mb-2">IDR {{ number_format($item->franchisePrice, 2) }}</p>
                                        <p class="mb-2 text-muted" style="font-size: 12px;">
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
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
