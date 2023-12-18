@extends('admin.admin_master') 
{{-- get header, sidebar, footer --}}

@section('admin')


<div class="page-content">
    <div class="container-fluid">

        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">All News</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title">All News</h4> <br>

                        <table id="datatable" class="table table-bordered dt-responsive nowrap" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                            <thead>
                            <tr>
                                <th>No</th>
                                <th>News Category</th>
                                <th>Author</th>
                                <th>News Title</th>
                                <th>News Tags</th>
                                <th>News Image</th> 
                                <th>Action</th>
                            </tr>
                            </thead>

                            <tbody>
                                @php($i = 1)
                                @foreach ($allNews  as $item)
                                <tr>
                                    <td>{{$i++}}</td>
                                    <td>{{$item['category']['newsCategory']}}</td>
                                    <td>{{$item->newsAuthor}}</td>
                                    <td style="width: 10rem">{{$item->newsTitle}}</td>
                                    <td>{{$item->newsTags}}</td>
                                    <td><img src="{{asset($item->newsImage)}}" alt="" class="" style="width: 5.5rem"></td>

                                    <td>
                                        <a href="{{route('edit.news', $item->id)}}" class="btn btn-info btn-sm" title="Edit News" >
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{route('delete.news', $item->id)}}" class="btn btn-danger btn-sm" title="Delete News" id="delete">
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