@extends('layouts.app')

@section('main')
    @vite('resources/css/franchise.css')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 imageContainer p-4" data-aos="fade" data-aos-duration="800">
                @if (
                    $franchise->isBought != 1 ||
                        (Auth::check() && (Auth::user()->id == $franchise->boughtBy || Auth::user()->id == $franchise->franchisePIC)))
                    <img class="img-fluid rounded" src="{{ asset($franchise->franchiseLogo) }}" alt="">
                @else
                    <img class="img-fluid rounded opacity-50" src="{{ asset($franchise->franchiseLogo) }}" alt="">
                    <div id="overlay" class="col-lg-12 col-md-12 col-sm-12">
                        <span class="material-symbols-rounded fw-light text-black opacity-50" style="font-size: 5rem">
                            lock
                        </span>
                        <h5 class="mt-3 text-black opacity-50">This franchise has been bought</h5>
                    </div>
                @endif
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12 rightContainer">
                <div class="titleContainer ppy-2">
                    <h1 class="fw-bold">{{ ucwords($franchise->franchiseName) }}</h1>
                    <hr>
                    <h3 class="fw-medium fs-5">By {{ ucwords($franchise->franchisePICName) }}</h3>
                </div>
                <div class="franchise-desc">
                    <div class="row mt-4">
                        <div class="col-md-4 d-grid">
                            <p>Price <br> <b>IDR {{ number_format($franchise->franchisePrice, 2, '.', ',') }}</b> </p>
                        </div>
                        <div class="col-md-4">
                            <p>Location <br> <b>{{ $franchise->franchiseLocation }}</b></p>

                        </div>
                        <div class="col-md-4">
                            <p>Category <br> <b>{{ $franchise->franchiseCategory }}</b></p>
                        </div>
                    </div>
                </div>
                <div class="d-flex flex-column">
                    @if (Auth::check())
                        @if (Auth::user()->id == $franchise->franchisePIC)
                            @if ($franchise->isBought != 1)
                                @include('modals.editFranchiseModal')
                                <button type="button" id="editFranchiseBtn"
                                    class="btn btn-info w-100 text-white rounded-pill mb-3" data-bs-toggle="modal"
                                    data-bs-target="#editFranchiseModal">Edit Franchise</button>
                            @else
                                <p>Bought by <br> <b>{{ $franchise->user->email }}</b></p>
                            @endif
                        @else
                            @if ($franchise->isBought != 1)
                                @include('modals.sendProposalModal')
                                <button type="button" id="sendProposalBtn"
                                    class="btn btn-info w-100 text-white rounded-pill mb-3" data-bs-toggle="modal"
                                    data-bs-target="#sendProposalModal">Send Proposal</button>
                                <a class="btn btn-warning text-white rounded-pill mb-3"
                                    href="/chat/{{ $franchise->franchisePIC }}" target="_blank">Send Message</a>
                            @else
                                @if (Auth::user()->id == $franchise->boughtBy)
                                    @include('modals.rateFranchiseModal')
                                    <div>
                                        <button type="button" id="rateFranchiseBtn"
                                            class="btn w-100 text-white rounded-pill mt-3 mb-2" data-bs-toggle="modal"
                                            data-bs-target="#rateFranchiseModal">Rate
                                            Franchise</button>
                                    </div>
                                @endif
                            @endif
                        @endif
                    @else
                        <a id="loginToSendProposal" href="{{ route('login') }}"
                            class="btn btn-info w-100 text-white rounded-pill mb-3">Login to send proposal to
                            franchise</button>
                    @endif
                    <a id="downloadFranchiseReportBtn" class="btn btn-light w-100 rounded-pill border border-1"
                        href="{{ asset($franchise->franchiseReport) }}"
                        download="Report {{ $franchise->franchiseName }}-{{ $franchise->franchiseReport }}">Download
                        Franchise Report</a>
                </div>
            </div>
        </div>

        <div class="container my-5" data-aos="fade" data-aos-duration="800">
            <ul class="nav nav-tabs" id="myTabs">
                <li class="nav-item">
                    <a class="nav-link active" id="description-tab" data-bs-toggle="tab" href="#description">Description</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="detail-tab" data-bs-toggle="tab" href="#detail">Detail Information</a>
                </li>
            </ul>
            <div class="tab-content mt-2">
                <div class="tab-pane fade show active" id="description">
                    <p>{!! $franchise->franchiseDesc !!}</p>
                </div>
                <div class="tab-pane fade" id="detail">
                    <ul class="list-group">
                        <li class="list-group-item"><b>Franchise Name : </b>{{ $franchise->franchiseName }} </li>
                        <li class="list-group-item"><b>Franchise Location : </b>{{ $franchise->franchiseLocation }} </li>
                        <li class="list-group-item"><b>Franchise Category : </b>{{ $franchise->franchiseCategory }} </li>
                        <li class="list-group-item"><b>Franchise Price :
                            </b>IDR {{ number_format($franchise->franchisePrice, 2, '.', ',') }} </li>

                        <li class="list-group-item"><b>Franchisor Name : </b>{{ $franchisor->name }} </li>
                        <li class="list-group-item"><b>Franchisor Email : </b>{{ $franchisor->email }} </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <div id="other-contents" class="row p-5 mt-4">
        <h3 class="text-center fw-bold mb-5">You might also like</h3>
        <div class="row">
            @if ($otherFranchise->count() == 0)
                <div class="col-lg-12 pb-3" data-aos="fade" data-aos-duration="800">
                    <div class="alert alert-warning w-100">No franchise found!</div>
                </div>
            @else
                @foreach ($otherFranchise as $item)
                    <div class="col-lg-3 col-md-6 col-sm-9 mb-3" data-aos="fade-down-left" data-aos-duration="1000">
                        <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                            style="overflow: hidden">
                            <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                <img src="{{ asset($item->franchiseLogo) }}" alt="Education Content Banner"
                                    class="img-fluid w-100" style="object-fit: cover; height: 100%; width: 100%;">
                            </div>
                            <div class="p-3">
                                <h3>{{ $item->franchiseName }}</h3>
                                <p class="mb-2 text-muted">By {{ $item->franchisePICName }}</p>
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
            @endif
        </div>
    </div>
@endsection
