@extends('admin.admin_master') 
{{-- get header, sidebar, footer --}}

@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All Franchise</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">All Franchise</h4> <br>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>Category</th>
                                <th>Name</th>
                                <th>Location</th>
                                <th>Price (Rp.)</th>
                                <th>Status</th>
                                <th>Report</th>
                                
                            </tr>
                            </thead>    
                           
                            <tbody>
                                @php($i = 1)
                                @foreach ($allFranchise  as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item->franchiseCategory}}</td>
                                    <td style="width: 10rem">{{$item->franchiseName}}</td>
                                    <td>{{$item->franchiseLocation}}</td>
                                    <td>{{ number_format($item->franchisePrice, 0, '.', ',') }}</td>

                                    @if ($item->status == 'Approved')
                                        <td style="background-color:aquamarine;">{{$item->status}}</td>
                                    @elseif($item->status == 'Rejected') 
                                        <td style="background-color: lightcoral; color:black;">{{$item->status}}</td>
                                        @else
                                        <td>{{$item->status}}</td>
                                    @endif

                                    <td><a href="{{asset($item->franchiseReport)}}" download="{{$item->franchiseName}}-{{$item->franchiseReport}}">Download</a></td>
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