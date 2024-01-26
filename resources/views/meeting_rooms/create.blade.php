@extends('layouts.app')
@section('color')
@endsection
@section('content')
@include('include.page-title-box')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">{{ $pageName }}</h4>
                <p class="sub-header"> ข้อมูลประจำวันที่ : {{ date('d M Y') }} </p>
 
                {!! Form::open(array('route' => 'meeting-rooms.store','method'=>'POST')) !!}
                @include('meeting_rooms.form')
                <hr>
                <div class="row">
                    <div class="col-md-12 text-right"> 
                        <a href="{{ route('meeting-rooms.index') }}" class="btn btn-dark waves-effect waves-light">
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
<script>
     
</script>
@endsection