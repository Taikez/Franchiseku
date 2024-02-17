@extends('admin.admin_master')
{{-- get header, sidebar, footer --}}

@section('admin')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">All Education</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">All Education</h4> <br>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>No</th>
                                        <th>Thumbnail</th>
                                        <th>Education Title</th>
                                        <th>Category</th>
                                        <th>Price</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php($i = 1)
                                    @foreach ($educations as $item)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td><img src="{{ asset($item->educationThumbnail) }}" class="w-50"
                                                    alt=""></td>
                                            <td>{{ $item->educationTitle }}</td>
                                            <td>{{ $item->category->educationCategory }}</td>
                                            <td>Rp {{ number_format($item->educationPrice, 2, ',', '.') }}</td>

                                            <td>
                                                <a href="{{route('edit.education',$item->id)}}" class="btn btn-info btn-sm" title="Edit data"
                                                    id="edit">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <a href="{{route('delete.education', $item->id)}}" class="btn btn-danger btn-sm" title="Delete data"
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
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- container-fluid -->
    </div>
@endsection
