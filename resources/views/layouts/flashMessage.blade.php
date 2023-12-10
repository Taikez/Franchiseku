@if ($message = Session::get('success'))
    <div class="alert alert-success alert-block">
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
            <strong class="text-center">{{ $message }}</strong>
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
        </div>
    </div>
@endif

@if ($message = Session::get('error'))
    <div class="alert alert-danger alert-block">
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
            <strong class="text-center">{{ $message }}</strong>
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
        </div>
    </div>
@endif

@if ($message = Session::get('warning'))
    <div class="alert alert-warning alert-block">
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
            <strong class="text-center">{{ $message }}</strong>
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
        </div>
    </div>
@endif

@if ($message = Session::get('info'))
    <div class="alert alert-info alert-block">
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
            <strong class="text-center">{{ $message }}</strong>
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
        </div>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
            <strong class="text-center">Some data are incorrect. Open the form to view.</strong>
            <button type="button" class="btn-close text-start" data-dismiss="alert"></button>
        </div>
    </div>
@endif
