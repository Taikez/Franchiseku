@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn-close text-end" data-dismiss="alert"></button>
            </div>
            <div class="col-9">
                <strong class="text-center">{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn-close text-end" data-dismiss="alert"></button>
            </div>
            <div class="col-9">
                <strong class="text-center">{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn-close text-end" data-dismiss="alert"></button>
            </div>
            <div class="col-9">
                <strong class="text-center">{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn-close text-end" data-dismiss="alert"></button>
            </div>
            <div class="col-9">
                <strong class="text-center">{{ $message }}</strong>
            </div>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <div class="row">
            <div class="col-3">
                <button type="button" class="btn-close text-end" data-dismiss="alert"></button>
            </div>
            <div class="col-9">
                <strong class="text-center">Some data are incorrect. Open the form to view.</strong>
            </div>
        </div>
    </div>
@endif
