@extends('layouts.app')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box">
            <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item">
                        <a href="{{ route('home') }}">หน้าหลัก</a>
                    </li>
                    <li class="breadcrumb-item">
                        <a href="{{ route('roles.index') }}">จัดการสิทธิ์ผู้ใช้งาน</a>
                    </li>
                    <li class="breadcrumb-item active">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</li>
                </ol>
            </div>
            <h4 class="page-title"> เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">เพิ่มข้อมูลสิทธิ์ผู้ใช้งาน</h4>
                <p class="sub-header">
                ข้อมูลประจำวันที่ {{ Date('d M Y') }}
                </p>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <strong>Whoops!</strong> มีปัญหาบางอย่างกับข้อมูลที่คุณป้อน
                </div>
                @endif

                {!! Form::open(array('route' => 'roles.store','method'=>'POST')) !!}
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <label> ชื่อสิทธิ์ผู้ใช้งาน : </label>
                            {!! Form::text('name', null, $attributes = $errors->has('name') ? array('placeholder' => 'Role Name', 'class'=>'form-control parsley-error') : array('placeholder' => 'ชื่อ', 'class'=>'form-control') ) !!}
                            @error('name')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="mb-2"><strong>สิทธิ์การอนุญาตเข้าใช้ : </strong></div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div id="accordion" class="mb-3">

                                    <?php $n = 1; ?>
                                    @foreach($permissionQTY as $key=>$row)
                                    <div class="mb-0">
                                        <div class="" id="heading{{ $n }}">
                                            <h5 class="m-0 bg-secondary mb-2 p-2" style="text-transform: uppercase;color: #fff;border-radius: 0.2rem;">
                                                <a href="#collapse{{ $n }}" class="text-dark" data-toggle="collapse" aria-expanded="true" aria-controls="collapse{{ $n }}">
                                                    <div class="d-flex justify-content-between" style="text-transform: uppercase;">
                                                        <div> {{ $key }} </div>
                                                        <div> <i class="fe-chevron-down"></i> </div>
                                                    </div>
                                                </a>
                                            </h5>
                                        </div>

                                        <div id="collapse{{ $n }}" class="collapse show" aria-labelledby="heading{{ $n }}" data-parent="#accordion">
                                            <div class="row p-2">
                                                <div class="checkbox col-md-12 ml-1 mb-2">
                                                    <input type="checkbox" id="checkboxall-{{ $n }}" class="checkbox-all" value="{{ $n }}">
                                                    <label for="checkboxall-{{ $n }}" class="m-0"> เลือกทั้งหมด </label>
                                                </div>
                                                @foreach($row as $row_2)
                                                <div class="col-md-4 checkbox checkbox-primary">
                                                    {{ Form::checkbox('permission[]', $row_2['id'], false, array('class' => 'checkbox-'.$n, 'id' => $row_2['id'])) }}
                                                    <label for="{{ $row_2['id'] }}" class="m-1">
                                                        <div>{{ $row_2['description'] }}</div>
                                                        <div class="text-danger" style="text-transform: uppercase;"><small>({{ $row_2['name'] }})</small></div>
                                                    </label>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <?php $n++; ?>
                                    @endforeach

                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <hr>
                        <a href="{{ route('roles.index') }}" class="btn btn-dark waves-effect waves-light">
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
    $(document).ready(function() {
        $(".checkbox-all").click(function() {
            if ($(this)[0].checked == true) {
                $(".checkbox-" + $(this).val() + ":checkbox").prop('checked', true);
            } else {
                $(".checkbox-" + $(this).val() + ":checkbox").prop('checked', false);
            }
        });
    });
</script>
@endsection