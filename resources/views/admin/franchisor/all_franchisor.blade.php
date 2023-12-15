@extends('admin.admin_master') 
{{-- get header, sidebar, footer --}}

@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Franchisor</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">All Franchisor</h4> <br>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th style="width:10px;">No</th>
                                <th>Username</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php($i = 1)
                                @foreach ($allFranchisor  as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->username}}</td>
                                    <td>{{$item->address}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{$item->phoneNumber}}</td>
                                   
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