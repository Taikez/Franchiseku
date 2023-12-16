@extends('layouts.app')

@section('main')
    @vite('resources/css/franchise.css')
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 imageContainer p-4">
                <img class="img-fluid rounded" src="{{ asset($franchise->franchiseLogo) }}" alt="">
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
                    @include('layouts.flashMessage')
                    @if (Auth::check() && Auth::user()->id == $franchise->franchisePIC)
                        @include('modals.editFranchiseModal')
                        <button type="button" id="editFranchiseBtn" class="btn btn-info w-100 text-white rounded-pill mb-3"
                            data-bs-toggle="modal" data-bs-target="#editFranchiseModal">Edit Franchise</button>
                    @else
                        @include('modals.sendProposalModal')
                        <button type="button" id="sendProposalBtn" class="btn btn-info w-100 text-white rounded-pill mb-3"
                            data-bs-toggle="modal" data-bs-target="#sendProposalModal">Send Proposal</button>
                        <a class="btn btn-warning text-white rounded-pill mb-3" href="/chat/{{$franchise->franchisePIC}}" target="_blank">Send Message</a>
                    @endif
                    <button type="button" id="downloadFranchiseReportBtn"
                        class="btn btn-light w-100 rounded-pill border border-1"
                        download="{{ $franchise->franchiseName }} - Report">Download Franchise Report</button>
                </div>
            </div>
        </div>

        <div class="container my-5">
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
                    <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Amet omnis numquam quibusdam quas eos nulla, adipisci reiciendis aliquam placeat similique! Ipsa ad voluptate assumenda vel veniam, quisquam veritatis necessitatibus eius natus placeat numquam velit excepturi id rerum, accusamus sint facilis labore iusto doloribus repellat quos libero. Corporis velit, dignissimos provident quis reprehenderit adipisci, eum quo sunt, ullam accusantium nisi quaerat? Quo voluptatem quae eius dolor non? Dolores numquam sed optio sequi odit? Repellendus, quae. Nobis quis veritatis corporis eveniet temporibus optio asperiores. Sed assumenda exercitationem, eius reprehenderit quae quis, vel quod excepturi nam neque id eaque, culpa maiores pariatur amet laborum ipsam ea ipsa praesentium veritatis? Dolor laboriosam provident quisquam hic molestias nisi vel nulla eaque iusto accusamus, velit, et, obcaecati laborum non consequatur quia. Repellat minus dolores cupiditate temporibus quasi quod eveniet consectetur reprehenderit quaerat eaque aliquid quos repudiandae commodi ipsa magni assumenda, iste cum aspernatur veniam enim exercitationem.
                    Lorem, ipsum dolor sit amet consectetur adipisicing elit. Magnam animi consequatur officiis perferendis alias consectetur, explicabo at! Ab nemo, officia ex amet distinctio laboriosam id numquam ratione culpa molestias facere officiis itaque assumenda at. Veritatis accusantium asperiores quos voluptates! Veniam consequuntur nostrum sint sapiente doloremque, cumque cupiditate nesciunt natus, quae porro atque blanditiis rerum quos libero totam accusantium in ducimus quas adipisci voluptates. Vero placeat harum vitae sequi quia voluptatibus voluptatum adipisci at illum itaque eum qui animi eos perspiciatis porro mollitia repellendus perferendis, alias temporibus soluta laudantium in eius tenetur enim. Rem placeat dolor vel sapiente error consequuntur culpa.
                    </p>
                </div>
                <div class="tab-pane fade" id="detail">
                    <ul class="list-group">
                        <li class="list-group-item"><b>Franchise Name : </b>{{ $franchise->franchiseName }} </li>
                        <li class="list-group-item"><b>Franchise Location : </b>{{ $franchise->franchiseLocation }} </li>
                        <li class="list-group-item"><b>Franchise Category : </b>{{ $franchise->franchiseCategory }} </li>
                        <li class="list-group-item"><b>Franchise Price : </b>{{ $franchise->franchisePrice }} </li>

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
                    <div class="col-lg-4 col-md-6 col-sm-9 mb-3" data-aos="fade-down-left" data-aos-duration="1000">
                        <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white"
                            style="overflow: hidden">
                            <div class="container-fluid w-100 m-0 p-0" style="overflow: hidden; height: 15rem">
                                <img src="{{ asset($item->franchiseLogo) }}" alt="Education Content Banner"
                                    class="img-fluid w-100" style="object-fit: cover; height: 100%; width: 100%;">
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
