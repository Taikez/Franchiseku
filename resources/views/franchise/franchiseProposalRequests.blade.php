@extends('layouts.app')

@section('title')
    Approve Franchise Proposal | FranchiseKu
@endsection

@section('main')
    <div class="container-fluid">
        <div class="row mb-3">
            <div class="col-md-12 p-5">
                <h1 class="text-center fw-bold" data-aos="fade-down" data-aos-duration="800">Franchise Proposal Requests</h1>
                <h5 class="text-center fw-light text-secondary">View and approve your proposal requests</h5>
            </div>
        </div>
        <div class="row">
            @if ($franchiseProposals->count() == 0)
                <div class="col-lg-12 p-5" data-aos="fade" data-aos-duration="800">
                    <div class="alert alert-warning w-100 text-center">You currently have no requests!</div>
                </div>
            @else
                @include('components.franchise-proposal-request-sidebar')
                <div class="col-9">
                    @include('layouts.flashMessage')
                    <table id="datatable" class="table table-bordered dt-responsive nowrap"
                        style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                        <thead>
                            <tr>
                                <th class="text-center">No</th>
                                <th class="text-center">Franchise Name</th>
                                <th class="text-center">Proposed By</th>
                                <th class="text-center">Proposal Date</th>
                                <th class="text-center">Proposal File</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @php($i = 1)
                            @foreach ($franchiseProposals as $franchiseProposal)
                                <tr>
                                    <td class="text-end">{{ $i++ }}</td>
                                    <td>{{ $franchiseProposal->franchise->franchiseName }}</td>
                                    <td>{{ $franchiseProposal->proposerName }}</td>
                                    <td>{{ $franchiseProposal->created_at }}</td>
                                    <td class="text-center"><a href="{{ asset($franchiseProposal->proposalFile) }}"
                                            class="btn btn-primary w-100"
                                            download="{{ $franchiseProposal->franchise->franchiseName }}-{{ $franchiseProposal->proposalFile }}">Download</a>
                                    </td>
                                    <td class="d-flex justify-content-between align-items-center text-center">
                                        <a href="{{ route('approve.franchise.proposal', $franchiseProposal->id) }}"
                                            class="btn btn-success w-50 mx-1" title="Edit News">
                                            Approve
                                        </a>
                                        <a href="{{ route('reject.franchise.proposal', $franchiseProposal->id) }}"
                                            class="btn btn-danger w-50 mx-1" title="Delete News" id="delete">
                                            Reject
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </div>
    </div>
@endsection
