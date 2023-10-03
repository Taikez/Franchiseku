@extends('layouts.app')

@section('main')
    @vite('resources/css/education.css')
    @vite('resources/js/education.js')

    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12 p-5">
                <h1 class="text-center fw-bold">Education Content Spread</h1>
                <p class="text-center text-secondary mb-4">You can learn something new everyday!</p>
                <div class="container-fluid w-100 mb-4">
                    <img src="{{ asset('frontendImg/educationContentBanner.png') }}" alt="Education Content Banner"
                        class="img-fluid">
                </div>

                <form action="{{ route('searchEducationContent') }}" class="col-md-6 mb-4" method="POST">
                    @csrf
                    <input type="text" class="form-control" placeholder="Search content here" name="searchValue">
                </form>
            </div>
        </div>

        <div class="row">
            <div id="education-vertical-menu" class="col-lg-2 col-md-2 col-sm-2 p-3">
                @include('components.education-sidebar')
            </div>
            <div class="col-lg-10">

            </div>
        </div>
    </div>
@endsection
