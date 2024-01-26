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
                    <li class="breadcrumb-item active">จัดการสิทธิ์ผู้ใช้งาน</li>
                </ol>
            </div>
            <h4 class="page-title"> จัดการสิทธิ์ผู้ใช้งาน </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">จัดการสิทธิ์ผู้ใช้งาน
                    @can('role-create')
                    <a href="{{ route('roles.create') }}" class="btn btn-primary waves-effect waves-light float-right">
                        <i class="fe-plus-square"></i> เพิ่มข้อมูล
                    </a>
                    @endcan
                </h4>
                <p class="sub-header">
                ข้อมูลประจำวันที่ {{ Date('d M Y') }}
                </p>

                @if ($message = Session::get('success'))
                <div class="alert alert-success text-success alert-dismissible fade show" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="mdi mdi-check-all mr-2"></i> {{ $message }}
                </div>
                @endif

                {!! Form::open(['route' => 'roles.index', 'method'=>'GET', 'class' => 'mb-2']) !!}
                <div class="row">
                    <div class="col-md-12">
                        <div class="d-flex">
                            <input type="search" class="form-control" id="keyword" name="keyword" placeholder="ค้นหาข้อมูลเพิ่มเติม....">
                            <div class="d-flex w-220">
                                <button class="btn btn-dark waves-effect waves-light ml-1" type="summit"><i class="fe-search"></i> ค้นหา</button>
                                <a href="{{ route('roles.index') }}" class="btn btn-dark waves-effect waves-light ml-1"><i class="fe-rotate-cw"></i> รีเฟรช </a>
                            </div>
                        </div>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                    <table class="table table-hover m-0 table-actions-bar">

                        <tr>
                            <th width="5%">ลำดับ</th>
                            <th>รายการสิทธิ์ผู้ใช้งาน</th>
                            <th width="10%">#</th>
                        </tr>

                        @foreach ($roles as $key => $role)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $role->name }}</td>
                            <td class="text-right"> 
                                @can('role-edit')
                                <a class="btn btn-dark waves-effect waves-light" href="{{ route('roles.edit',$role->id) }}">แก้ไข</a>
                                @endcan 
                                @can('role-delete')
                                {!! Form::open(['method' => 'DELETE','route' => ['roles.destroy', $role->id],'style'=>'display:inline', 'id' => 'delete-confirm2']) !!}
                                {!! Form::submit('ลบข้อมูล', ['class' => 'btn btn-danger waves-effect waves-light delete-confirm']) !!}
                                {!! Form::close() !!}
                                @endcan
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>

                {!! $roles->render() !!}

            </div>
        </div>
    </div>
</div>
@endsection