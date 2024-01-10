@extends('layouts.app')

@section('title')
    Owned Franchises | FranchiseKu
@endsection

@section('main')
    <div class="page-conten p-5">
        <div class="container-fluid">
            <div class="row mb-3">
                <div class="col-md-12 p-5">
                    <h1 class="text-center fw-bold" data-aos="fade-down" data-aos-duration="800">Your Franchises
                    </h1>
                    <h5 class="text-center fw-light text-secondary">View and delete your franchises here</h5>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    @if ($allFranchise->count() == 0)
                        <div class="col-lg-12 p-5" data-aos="fade" data-aos-duration="800">
                            <div class="alert alert-warning w-100 text-center">You currently have no franchises! Would you
                                like to <a href="{{ route('register.franchise') }}" id="registerFranchiseLink"
                                    class="link-primary">Register a
                                    Franchise?</a></div>
                        </div>
                    @else
                        <div class="card" data-aos="fade" data-aos-duration="800">
                            <div class="card-body">
                                <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                    style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Name</th>
                                            <th>Category</th>
                                            <th>Location</th>
                                            <th>Price</th>
                                            <th>Approval Status</th>
                                            <th>Investor</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php($i = 1)
                                        @foreach ($allFranchise as $item)
                                            <tr>
                                                <td>{{ $i++ }}</td>
                                                <td>{{ $item->franchiseName }}</td>
                                                <td>{{ $item->franchiseCategory }}</td>
                                                <td>{{ $item->franchiseLocation }}</td>
                                                <td>{{ number_format($item->franchisePrice, 2) }}</td>
                                                <td>{{ $item->status }}</td>
                                                @if ($item->isBought == 1)
                                                    <td>{{ $item->user->name }}</td>
                                                @else
                                                    <td>No investors yet!</td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('franchise.detail', $item->id) }}"
                                                        class="btn btn-info btn-sm" title="Detail Franchise">
                                                        <i class="fas fa-book-reader text-white"></i>
                                                    </a>
                                                    <a href="{{ route('delete.franchise', $item->id) }}"
                                                        class="btn btn-danger btn-sm" title="Delete Franchise"
                                                        id="delete">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
