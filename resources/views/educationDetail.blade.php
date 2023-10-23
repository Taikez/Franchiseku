@extends('layouts.app')

@section('main')
    <div class="container-fluid d-flex bg-white">
        <div id="left-content" class="col-lg-8 col-md-8 col-sm-12 p-5">
            <div id="content-title" class="text-center mb-5">
                <h1 class="fw-bold mb-2" style="color: #015051">{{ $education->educationTitle }}</h1>
                <h6 class="mb-4" style="color: #015051">Home / Education / Detail</h6>
                <div class="mb-4" style="width: 25%; height: 3px; background-color: #D9D9D9; margin: auto;"></div>
            </div>
            <div id="content-text" class="px-5 fw-lighter">
                <h6>{!! $education->educationDesc !!}</h6>
            </div>
        </div>

        <div id="right-content" class="col-lg-4 col-md-4 col-sm-12">
            kanan
        </div>
    </div>
@endsection
