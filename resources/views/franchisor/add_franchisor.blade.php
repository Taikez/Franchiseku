@extends('layouts.app')

@section('title')
    Add Franchise | FranchiseKu
@endsection


@section('main')
    <section class="registerFranchisor d-flex align-items-center" id="registerFranchisor">

        <div class="container bg-light bg-opacity-80 rounded mt-4 p-4">
            <div class="row d-flex align-items-center h-100">
                <div class="col-md-6  p-4">
                    <h1 class="fs-1 text-primary mb-5 fw-bold ">Become One of Our Franchisor</h1>
                    <p class="fw-light fs-5">Embark on a Lucrative Journey: Transform Your Business into a Franchise! Explore
                        the Benefits and Register as a Franchisor with Us Today. Join a Network of Success and Propel Your
                        Brand Forward.</p>
                </div>
                <div class="col-md-6  p-4 ">
                    <form action="{{ route('store.franchisor') }}" method="POST">
                        @csrf
                        <div class="form-group mb-3">
                            <label for="username">Franchisor Name</label>
                            <input type="text" class="form-control" id="username" name="username"
                                value="{{ old('username') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" id="email" name="email"
                                value="{{ old('email') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="phoneNumber">Phone Number</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber"
                                value="{{ old('phoneNumber') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="address">Address</label>
                            <input type="text" class="form-control" id="address" name="address"
                                value="{{ old('address') }}">
                        </div>
                        <div class="form-group mb-3">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>
                        <button type="submit" class="btn btn-lg p-4 pt-1 pb-1 btn-primary rounded mt-4">Apply</button>
                    </form>

                </div>
            </div>
        </div>
    </section>
@endsection
