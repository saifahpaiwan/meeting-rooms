@extends('layouts.app')
@section('style')
<link rel="stylesheet" type="text/css" href="{{ asset('template/libs/tagify/tagify.css') }}">
<style>
    .tagify {
        width: 100%;
    }

    .tagify__tag>div {
        padding: 0.15rem 0.5rem !important;
    }

    .tagify__tag>div::before {
        box-shadow: unset;
        background: #ddd;
    }
</style>
@endsection
@section('content')
@include('include.page-title-box')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">{{ $pageName }}</h4>
                <p class="sub-header"> ข้อมูลประจำวันที่ : {{ date('d M Y') }} </p>

                {!! Form::model("", ['method' => 'PATCH','route' => ['meetings.update', $data->id]]) !!}
                @include('meetings.form')
                <hr>
                <div class="row">
                    <div class="col-md-12 text-right">
                        <a href="{{ route('meetings.index') }}" class="btn btn-dark waves-effect waves-light">
                            <i class="fe-chevron-left"></i> ย้อนกลับ
                        </a>
                        <button type="submit" class="btn btn-primary waves-effect waves-light">
                            <i class="fe-save"></i> บันทึก
                        </button>
                    </div>
                </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('template/libs/tagify/tagify.js') }}"></script>
<script>
     $('#booker_id').select2();
     $('#meeting_rooms_id').select2();
    var inputSendTo = document.getElementById('send_to');
    var tagify;
    getWhitelist();

    function getWhitelist() {
        $.ajax({
            url: "{{ route('get.users') }}",
            type: 'POST',
            data: {
                _token: "{{ csrf_token() }}"
            },
            success: function(response) {
                console.log(response);

                var whitelist = response;
                initTagify(whitelist);
            }
        });
    }

    function initTagify(whitelist) {
        if (!tagify) {
            tagify = new Tagify(inputSendTo, {
                whitelist: whitelist
            });
        } else {
            tagify.settings.whitelist = whitelist;
            tagify.updateSettings();
        }
    }
</script>
@endsection