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
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit tempore culpa quae distinctio
                        excepturi recusandae amet, quaerat vitae explicabo dignissimos? Rem officiis a in cupiditate quos,
                        quis ullam eveniet molestiae enim. Odio doloribus repudiandae laudantium iusto vero quae
                        necessitatibus autem voluptatum facere hic dolore asperiores debitis accusantium rerum aspernatur
                        fugit ex, officiis amet. Quidem ex vel omnis provident ipsum nesciunt quam cumque laudantium quaerat
                        totam, rem ratione quo veritatis quasi labore voluptas debitis blanditiis officia consectetur ad,
                        error deleniti officiis! Aspernatur eum perferendis laboriosam, temporibus nostrum, doloremque,
                        molestiae est impedit officiis quas numquam. Expedita ex reprehenderit praesentium maiores quae rem
                        ad quas incidunt assumenda, nulla delectus cum nisi corporis alias aperiam dolorem neque sapiente
                        nam necessitatibus explicabo. Rerum officiis error harum tempore fuga inventore nisi, qui atque eius
                        itaque quisquam culpa, nihil laboriosam possimus commodi? Sint quas perspiciatis minima doloribus
                        debitis ab officiis, cumque obcaecati eius odit modi sunt quos iure omnis amet praesentium illo
                        magnam ea voluptas nesciunt assumenda distinctio natus exercitationem ex. Asperiores nesciunt quam
                        nemo nostrum deserunt debitis magnam sunt omnis a magni, praesentium itaque eos ipsa neque modi
                        eveniet in? Tempora voluptas amet, harum, enim dolor voluptatibus itaque obcaecati, odio nisi
                        quibusdam libero incidunt fugit quod iste eos vero cum nihil. Mollitia ad et quidem distinctio,
                        tempora fuga culpa sint, ullam maxime veritatis voluptates illum ipsa. Vel, aliquid amet deserunt
                        quas, fugit illo unde incidunt expedita iusto a numquam inventore vitae, voluptatem libero id
                        debitis reiciendis autem voluptas mollitia necessitatibus dolores illum. Nemo pariatur eum
                        reprehenderit voluptatibus odit, quos doloremque quibusdam, esse quis alias expedita! Expedita quo
                        iste nihil corrupti esse odio quasi architecto voluptas? Obcaecati, non fugiat culpa earum,
                        accusamus, delectus autem asperiores recusandae assumenda provident adipisci veniam labore
                        doloremque sequi soluta quisquam cumque ipsam. Eaque quo vero veritatis voluptatem qui fuga illum
                        itaque optio!
                    </p>
                </div>
                <div class="tab-pane fade" id="detail">
                    <ul class="list-group">
                        <li class="list-group-item"><b>Franchise Name : </b>{{$franchise->franchiseName}} </li>
                        <li class="list-group-item"><b>Franchise Location : </b>{{$franchise->franchiseLocation}} </li>
                        <li class="list-group-item"><b>Franchise Category : </b>{{$franchise->franchiseCategory}} </li>
                        <li class="list-group-item"><b>Franchise Price : </b>{{$franchise->franchisePrice}} </li>
                      
                        <li class="list-group-item"><b>Franchisor Name : </b>{{$franchisor->name}} </li>
                        <li class="list-group-item"><b>Franchisor Email : </b>{{$franchisor->email}} </li>
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
