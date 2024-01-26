@if ($message = Session::get('info'))
<div class="alert bg-blue text-info alert-dismissible fade show position-alert align-items-center">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">×</span>
    </button>
    <div class="d-flex justify-content-start align-items-center">
        <div class="p-1"><i class="fe-alert-circle alert-icon-size text-white"></i></div>
        <div class="ml-2">
            <h5 class="text-white">Informertion!</h5>
            <p class="m-0 text-white"> {{ $message; }} </p>
        </div>
    </div>
</div>
@endif