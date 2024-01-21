@extends('admin.admin_master')
@section('admin')

<div class="page-content">
    <div class="container-fluid">
        
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                    <h4 class="mb-sm-0">Dashboard</h4>

                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Upcube</a></li>
                            <li class="breadcrumb-item active">Dashboard</li>
                        </ol>
                    </div>

                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Total Education</p>
                                <h4 class="mb-2">{{$currentEducation}}</h4>
                                <p class="text-muted mb-0">
                                    <span class="text-success fw-bold font-size-12 me-2"><i class="ri-arrow-right-up-line me-1 align-middle"></i>{{$educationDifference}}</span>from previous month
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-shopping-cart-2-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                            
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Total Franchise</p>
                                <h4 class="mb-2">{{$currentFranchise}}</h4>
                                 <p class="text-muted mb-0">
                                    <span class="text-success fw-bold font-size-12 me-2">
                                        <i class="ri-arrow-right-up-line me-1 align-middle"></i>{{$franchiseDifference}}</span>from previous month
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-currency-usd font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Total User</p>
                                <h4 class="mb-2">{{$currentUser}}</h4>
                                <p class="text-muted mb-0">
                                    <span class="text-success fw-bold font-size-12 me-2">
                                        <i class="ri-arrow-right-up-line me-1 align-middle"></i>{{$userDifference}}</span>from previous month
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-primary rounded-3">
                                    <i class="ri-user-3-line font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
            <div class="col-xl-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex">
                            <div class="flex-grow-1">
                                <p class="text-truncate font-size-14 mb-2">Total Franchisor</p>
                                <h4 class="mb-2">{{$currentFranchisor}}</h4>
                                <p class="text-muted mb-0"><span class="text-success fw-bold font-size-12 me-2">
                                    <i class="ri-arrow-right-up-line me-1 align-middle"></i>{{$franchisorDifference}}</span>from previous month
                                </p>
                            </div>
                            <div class="avatar-sm">
                                <span class="avatar-title bg-light text-success rounded-3">
                                    <i class="mdi mdi-currency-btc font-size-24"></i>  
                                </span>
                            </div>
                        </div>                                              
                    </div><!-- end cardbody -->
                </div><!-- end card -->
            </div><!-- end col -->
        </div><!-- end row -->

       
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-body">
                        <div class="dropdown float-end">
                            <a href="#" class="dropdown-toggle arrow-none card-drop" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="mdi mdi-dots-vertical"></i>
                            </a>
                            
                        </div>

                        <h4 class="card-title mb-4">Latest Education Transactions</h4>

                        <div class="table-responsive">
                            <table class="table table-centered mb-0 align-middle table-hover table-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Payment Type</th>
                                        <th>Education</th>
                                        <th>Total price</th>
                                        <th style="width: 120px;">Status</th>
                                    </tr>
                                </thead><!-- end thead -->
                                <tbody>
                                    @if ($transactions->count() <= 0)
                                        <div class="col-12" data-aos="fade" data-aos-duration="800">
                                            <div class="alert alert-warning w-100">There is no transaction yet!</div>
                                        </div>
                                    @else    
                                        @foreach ($transactions as $item)
                                        <tr>
                                            <td><h6 class="mb-0">{{$item->username}}</h6></td>
                                            <td>{{$item->email}}</td>
                                            <td>{{$item->paymentType}}</td>
                                            <td>{{$item->education_id}}</td>
                                            <td>{{$item->total_price}}</td>
                                            <td>
                                                <div class="font-size-13">
                                                    @if($item->transaction_status == 'pending')
                                                        <i class="ri-checkbox-blank-circle-fill font-size-10 text-warning align-middle me-2"></i>{{$item->transaction_status}}
                                                    @else
                                                        <i class="ri-checkbox-blank-circle-fill font-size-10 text-success align-middle me-2"></i>{{$item->transaction_status}}
                                                    @endif
                                                </div>
                                            </td>
                                        @endforeach
                                    @endif
                                </tbody><!-- end tbody -->
                            </table> <!-- end table -->
                        </div>
                    </div><!-- end card -->
                </div><!-- end card -->
            </div>
            <!-- end col -->
      
        </div>
        <!-- end row -->
    </div>
    
</div>

@endsection