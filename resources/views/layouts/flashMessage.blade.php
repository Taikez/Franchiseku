@if ($message = Session::get('success'))
    <div class="alert alert-success alert-dismissable">
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-dismissable">
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-dismissable">
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($message = Session::get('info'))
    <div class="alert alert-info alert-dismissable">
        <strong>{{ $message }}</strong>
    </div>
@endif
@if ($errors->any())
    <div class="alert alert-danger alert-dismissable">
        Please check the form below for errors
    </div>
@endif
