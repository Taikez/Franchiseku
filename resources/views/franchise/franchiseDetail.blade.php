@extends('layouts.app')

@section('main')
    @vite('resources/css/franchise.css')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-6 imageContainer p-4">
                <img class="img-fluid rounded" src="{{ asset($franchise->franchiseLogo) }}" alt="">
            </div>
            <div class="col-md-6 rightContainer">
                <div class="titleContainer ppy-2">
                    <h1 class="fw-bold">{{ ucwords($franchise->franchiseName) }}</h1>
                    <hr>
                    <h3 class="fw-medium fs-5">By {{ ucwords($franchise->franchisePICName) }}</h3>
                </div>
                <div class="franchise-desc">
                    <div class="row mt-4">
                        <div class="col-md-4 d-grid">
                            <p>Price <br> <b>Rp {{ number_format($franchise->franchisePrice, 0, '.', ',') }}</b> </p>
                        </div>
                        <div class="col-md-4">
                            <p>Location <br> <b>{{ $franchise->franchiseLocation }}</b></p>

                        </div>
                        <div class="col-md-4">
                            <p>Category <br> <b>{{ $franchise->franchiseCategory }}</b></p>
                        </div>
                    </div>
                </div>
                <div>
                    @include('layouts.flashMessage')
                    @include('modals.sendProposalModal')
                    <button type="button" id="sendProposalBtn" class="btn btn-info w-100 text-white rounded-pill"
                        data-bs-toggle="modal" data-bs-target="#sendProposalModal">Send Proposal</button>
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
                    <p>
                        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore
                        et
                        dolore magna aliqua.
                    </p>
                </div>
                <div class="tab-pane fade" id="detail">
                    <p>
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Omnis, quos praesentium! Incidunt optio
                        cupiditate laudantium sequi accusantium minus, neque at voluptates perspiciatis doloribus dolores?
                        Fuga nisi illo excepturi voluptatem itaque quam molestias vel laboriosam esse, quae facilis labore,
                        aperiam alias, ducimus officiis! Veritatis laudantium deserunt harum reiciendis quis soluta iusto
                        vero, minus inventore nisi id, culpa itaque. Facere delectus sed ipsam. Accusantium libero deserunt
                        sunt quis dolorem officia suscipit iure dolorum nisi commodi, placeat provident veniam dignissimos
                        dolore asperiores, a corrupti inventore perspiciatis earum debitis eligendi perferendis. Recusandae
                        accusamus dignissimos provident nulla? Ipsum odit repudiandae nulla quam, laboriosam fugiat vitae
                        sed alias pariatur dolorem laborum iure rerum. Cumque repellat nam odio explicabo cum, reprehenderit
                        voluptate laborum! Laboriosam quae exercitationem cum atque omnis mollitia magnam debitis,
                        consequatur, dolores odit consequuntur! Soluta tempora repudiandae ab ex, quia aperiam praesentium
                        maxime pariatur necessitatibus qui molestiae error suscipit iure dolore! Inventore dolore, unde ipsa
                        vero possimus quam laudantium reprehenderit libero ratione blanditiis id! Ut cupiditate hic
                        dignissimos nobis odio temporibus sit, non inventore commodi nostrum voluptas molestias quas placeat
                        magnam iste possimus aspernatur explicabo, sapiente dolorem cumque magni. Animi atque, fugit quis,
                        odit quo quia eos asperiores doloremque corrupti sunt, repellendus magnam ea odio.
                    </p>
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
