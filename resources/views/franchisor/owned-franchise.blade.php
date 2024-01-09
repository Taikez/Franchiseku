@extends('layouts.app')

@section('title')
    Owned Franchises | FranchiseKu
@endsection

@section('main')
    <div class="page-conten p-5">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">Your Franchises</h4> <br>

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
                                                    class="btn btn-danger btn-sm" title="Delete News" id="delete">
                                                    <i class="fas fa-trash-alt"></i>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
