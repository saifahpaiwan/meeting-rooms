@if ($message = Session::get('success'))
<div class="alert bg-success text-success alert-dismissible fade show position-alert align-items-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex justify-content-start align-items-center">
        <div class="p-1"><i class="fe-check-circle alert-icon-size text-white"></i></div>
        <div class="ml-2">
            <h5 class="text-white">Successful entry.</h5>
            <p class="m-0 text-white">{{ $message }}</p>
        </div>
    </div>
</div>
@endif