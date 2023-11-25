@extends('layouts.app')

@section('title')
    Add Franchise | FranchiseKu
@endsection


@section('main')
<section class="registerFranchise d-flex align-items-center" id="registerFranchise">

    
        <div class="container bg-light bg-opacity-80 rounded mt-4 p-4" >
            <div class="row d-flex align-items-center h-100" >
                <div class="col-md-6  p-4">
                    <h1 class="fs-1 text-primary mb-5 fw-bold ">Register Franchise</h1>
                    <p class="fw-light fs-5">Used and supported in over 178 countries around the globe. We'll work with you to open more doors and help you look for your suitable customers</p>
                </div>
                <div class="col-md-6  p-4 ">
                    <form action="{{ route('store.franchise') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="franchiseName">Franchise Name</label>
                            <input type="text" class="form-control @error('franchiseName') is-invalid @enderror" id="franchiseName" name="franchiseName" value="{{ old('franchiseName') }}">
                            @error('franchiseName')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="franchiseLocation">Franchise Location</label>
                            <input type="text" class="form-control @error('franchiseLocation') is-invalid @enderror" id="franchiseLocation" name="franchiseLocation" value="{{ old('franchiseLocation') }}">
                            @error('franchiseLocation')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="franchiseCategory">Franchise Category</label>
                            <select class="form-control @error('franchiseCategory') is-invalid @enderror" id="franchiseCategory" name="franchiseCategory">
                                @foreach ($allFranchiseCategory as $item)                                
                                    <option value="{{ $item->franchiseCategory }}"{{ old('franchiseCategory') == $item->franchiseCategory ? 'selected' : '' }}>{{ $item->franchiseCategory }}</option>
                                @endforeach
                            </select>
                            @error('franchiseCategory')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    
                        <div class="form-group mb-3">
                            <label for="franchisePrice">Price</label>
                            <input type="number" class="form-control @error('franchisePrice') is-invalid @enderror" placeholder="Rp." id="franchisePrice" name="franchisePrice" value="{{ old('franchisePrice') }}">
                            @error('franchisePrice')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label for="franchiseReport">Report</label>
                            <input id="franchiseReport" accept=".pdf, .doc, .docx, .xls, .xlsx, .zip" name="franchiseReport" type="file" class="form-control @error('franchiseReport') is-invalid @enderror">
                            @error('franchiseReport')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
     
                        <button type="submit" class="btn btn-lg p-4 pt-1 pb-1 btn-primary rounded mt-4">Register Franchise</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection