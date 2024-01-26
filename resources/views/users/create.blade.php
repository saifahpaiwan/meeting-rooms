@extends('layouts.app')
@section('style')
@endsection
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
                        <a href="{{ route('users.index') }}">จัดการผู้ใช้งานระบบ</a>
                    </li>
                    <li class="breadcrumb-item active">เพิ่มผู้ใช้งานระบบ</li>
                </ol>
            </div>
            <h4 class="page-title"> จัดการผู้ใช้งานระบบ </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">เพิ่มผู้ใช้งานระบบ</h4>
                <p class="sub-header">
                    ข้อมูลประจำวันที่ {{ date('d M Y') }}
                </p>
 

                {!! Form::open(array('id' => 'demo-1', 'route' => 'users.store','method'=>'POST', 'enctype' => 'multipart/form-data')) !!}
                <div class="row">
  
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>อีเมล (Email) : <span class="text-danger">*</span></label>
                            {!! Form::email('email', null, $attributes = $errors->has('email') ? array('placeholder' => 'Email', 'class'=>'form-control parsley-error') : array('placeholder' => 'Email', 'class'=>'form-control') ) !!}
                            @error('email')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label>เบอร์โทร (Phone) : </label>
                            {!! Form::text('phone', null, $attributes = $errors->has('phone') ? array('placeholder' => 'Phone', 'class'=>'form-control parsley-error') : array('placeholder' => 'Phone', 'class'=>'form-control') ) !!}
                            @error('phone')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>Username : <span class="text-danger">*</span></label>
                            {!! Form::text('username', null, $attributes = $errors->has('username') ? array('placeholder' => 'Name', 'class'=>'form-control parsley-error') : array('placeholder' => 'Name', 'class'=>'form-control') ) !!}
                            @error('username')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>รหัสผ่าน (Password) : <span class="text-danger">*</span></label>
                            {!! Form::password('password',
                            $attributes = $errors->has('password')
                            ? array('placeholder' => 'Password','class' => 'form-control parsley-error')
                            : array('placeholder' => 'Password','class' => 'form-control') ) !!}
                            @error('password')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>ยืนยันรหัสผ่าน (Confirm Password) : <span class="text-danger">*</span></label>
                            {!! Form::password('confirm-password',
                            $attributes = $errors->has('confirm-password')
                            ? array('placeholder' => 'Confirm Password','class' => 'form-control parsley-error')
                            : array('placeholder' => 'Confirm Password','class' => 'form-control') ) !!}
                            @error('confirm-password')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
 
                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="status-1"> สถานะการแสดงผล <span class="text-danger">*</span></label>
                            <div class="mt-2">
                                <div class="radio radio-success form-check-inline">
                                    <input type="radio" id="status-1" value="1" name="status" @if(isset($data->status) && $data->status==1) {{ __('checked') }} @endif
                                    @if(!empty(old('status')) && old('status')==1) {{ __('checked') }} @endif
                                    @if(!isset($data->status) && empty(old('status'))) {{ __('checked') }} @endif>
                                    <label for="status-1">
                                        <span class="badge badge-success p-1"> Enable </span>
                                    </label>
                                </div>
                                <div class="radio radio-secondary form-check-inline">
                                    <input type="radio" id="status-0" value="0" name="status" @if(isset($data->status) && $data->status==0) {{ __('checked') }} @endif
                                    @if(!empty(old('status')) && old('status')==0) {{ __('checked') }} @endif>
                                    <label for="status-0">
                                        <span class="badge badge-secondary p-1"> Disable </span>
                                    </label>
                                </div>
                            </div>
                            <hr>
                            <div class="mt-2 mb-2">
                                <div class="checkbox checkbox-secondary form-check-inline">
                                    <input type="checkbox" id="receive_notifications_email-1" value="Y" name="receive_notifications_email" @if(isset($data->receive_notifications_email) && $data->receive_notifications_email=='Y') {{ __('checked') }} @endif
                                    @if(!empty(old('receive_notifications_email')) && old('receive_notifications_email')==1) {{ __('checked') }} @endif>
                                    <label for="receive_notifications_email-1">
                                        <span class="badge badge-secondary p-1"> เปิดการแจ้งเตือน Email </span>
                                    </label>
                                </div>
                            </div>
                            <div class="mt-2 mb-2">
                                <div class="checkbox checkbox-secondary form-check-inline">
                                    <input type="checkbox" id="receive_notifications_system-0" value="Y" name="receive_notifications_system" @if(isset($data->receive_notifications_system) && $data->receive_notifications_system=='Y') {{ __('checked') }} @endif
                                    @if(!empty(old('receive_notifications_system')) && old('receive_notifications_system')==0) {{ __('checked') }} @endif>
                                    <label for="receive_notifications_system-0">
                                        <span class="badge badge-secondary p-1"> เปิดการแจ้งเตือน ระบบ </span>
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    @can('user-set-roles')
                    <div class="col-md-4">
                        <div class="form-group">
                            <label>สิทธิ์ผู้ใช้งาน : <span class="text-danger">*</span></label>
                            {!! Form::select('roles[]', $roles,[],
                            $attributes = $errors->has('roles')
                            ? array('class'=>'form-control parsley-error', 'multiple')
                            : array('class'=>'form-control', 'multiple') ) !!}
                            @error('roles')
                            <ul class="parsley-errors-list filled">
                                <li class="parsley-required">{{ $message }}</li>
                            </ul>
                            @enderror
                        </div>
                    </div>
                    @endcan

                    <div class="col-md-12 text-right">
                        <hr>
                        <a href="{{ route('users.index') }}" class="btn btn-dark waves-effect waves-light">
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
    $(document).on('change', '#images_name', function(event) {
        html = '<div class="box-image-no" style="background: #ddd;border-radius: 50%; width: 100px; height: 100px;"> </div>';
        $('.img-file-upload-1').html(html);
        var Images = $('#images_name');
        if (Images[0].files[0]) {
            url = window.URL.createObjectURL(Images[0].files[0]);
            html = '<div class="box-image-no" style="background: url(' + url + '); background-size: cover; background-position: center;border-radius: 50%; width: 100px; height: 100px;"> </div>';
        }
        $('.img-file-upload-1').html(html);
    });
</script>
@endsection