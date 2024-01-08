@extends('layouts.app')

@section('title')
    Franchise History | FranchiseKu
@endsection

@section('main')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-5">
                <h1 class="text-center fw-bold" data-aos="fade-down" data-aos-duration="800">Franchise History</h1>
            </div>
        </div>
        <div class="row mb-4">
            <div class="col-lg-12 col-md-12 col-sm-12 px-3">
                <form action="{{ route('history.franchise.search') }}" class="col-md-12" method="POST">
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

            <div class="col-lg-4 col-md-4 col-sm-12"></div>
        </div>
        <div class="row">
            @include('components.history-franchise-sidebar')
            @if ($franchiseProposals->count() == 0)
                <div class="col-lg-9 pb-3" data-aos="fade" data-aos-duration="800">
                    <div class="alert alert-warning w-100">Your history is empty!</div>
                </div>
            @else
                <div class="col-lg-8 mx-5">
                    <div class="row">
                        @foreach ($franchiseProposals as $franchiseProposal)
                            <div class="fixed-height-box h-100 rounded border border-1 shadow-sm bg-white p-4 px-5 mx-3 mb-5"
                                style="overflow: hidden">
                                <h3 class="fw-bold">{{ $franchiseProposal->franchise->franchiseName }}</h3>
                                <hr class="mb-5">
                                <div class="row mb-5">
                                    <div class="col-lg-3 col-md-2 col-sm-12">
                                        <img id="thumbnail" class="img-fluid rounded-3"
                                            src="{{ asset($franchiseProposal->franchise->franchiseLogo) }}"
                                            alt="Franchise Logo">
                                    </div>
                                    <div class="col-lg-6 col-md-7 col-sm-12">
                                        <p><b style="margin-right: 1rem;">Proposal sent:</b>
                                            {{ \Carbon\Carbon::parse($franchiseProposal->franchise->created_at)->format('d F Y') }}
                                        </p>
                                        <p><b style="margin-right: 1rem;">Category:</b>
                                            {{ $franchiseProposal->franchise->franchiseCategory }}</p>
                                        <p><b style="margin-right: 1rem;">Price:</b> IDR
                                            {{ number_format($franchiseProposal->franchise->franchisePrice, 2) }}</p>
                                    </div>
                                    <div class="col-lg-3 col-md-6 col-sm-12">
                                        <p>Status:</p>
                                        @if ($franchiseProposal->status == 'Requested')
                                            <p class="text-warning fw-bold">Proposal Sent</p>
                                        @elseif($franchiseProposal->status == 'Approved')
                                            <p class="text-success fw-bold">Proposal Accepted</p>
                                        @elseif($franchiseProposal->status == 'Rejected')
                                            <p class="text-danger fw-bold">Proposal Rejected</p>
                                        @else
                                            <p class="text-warning fw-bold">Not found</p>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <a href="{{ route('franchise.detail', $franchiseProposal->franchise->id) }}"
                                    class="d-flex justify-content-between">
                                    <div>
                                        View Detail
                                    </div>
                                    <div>
                                        <span class="material-symbols-rounded">
                                            north_east
                                        </span>
                                    </div>
                                </a>
                            </div>
                        @endforeach
                    </div>
                    <div class="mt-5">
                        {{ $franchiseProposals->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection
