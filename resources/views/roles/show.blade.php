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
                    <li class="breadcrumb-item active">แสดงรายการสิทธิ์ผู้ใช้งาน</li>
                </ol>
            </div>
            <h4 class="page-title"> แสดงรายการสิทธิ์ผู้ใช้งาน </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">แสดงรายการสิทธิ์ผู้ใช้งาน</h4>
                <p class="sub-header">
                    ข้อมูลประจำวันที่ {{ Date('d M Y') }}
                </p>

                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <strong>ชื่อ : </strong>
                            {{ $role->name }}
                        </div>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-12">
                        <div class="form-group">
                            <div class="mb-2"> <strong>สิทธิ์การอนุญาตเข้าใช้</strong> </div>

                            @if(!empty($rolePermissions))
                            @foreach($rolePermissions as $v)
                            <span class="badge badge-dark ml-1 p-1">{{ $v->name }}</span>
                            @endforeach
                            @endif
                        </div>
                    </div>
                </div>

                <hr>
                <a href="{{ route('roles.index') }}" class="btn btn-dark waves-effect waves-light">
                    <i class="fe-chevron-left"></i> ย้อนกลับ
                </a>
                <a class="btn btn-warning waves-effect waves-light" href="{{ route('roles.edit', $role->id) }}">
                    <i class="fe-edit"></i> แก้ไข
                </a>
            </div>
        </div>
    </div>
</div>
@endsection