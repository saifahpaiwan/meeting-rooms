@extends('layouts.app')
@section('style')
<link href="{{ asset('template/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
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
                    <li class="breadcrumb-item active">จัดการผู้ใช้งานระบบ</li>
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
                <h4 class="header-title">จัดการผู้ใช้งานระบบ
                    @can('user-create')
                    <a href="{{ route('users.create') }}" class="btn btn-primary waves-effect waves-light float-right">
                        <i class="fe-plus-square"></i> เพิ่มข้อมูล
                    </a>
                    @endcan
                </h4>
                <p class="sub-header">
                    ข้อมูลประจำวันที่ {{ date('d M Y') }}
                </p>
  
                <div class="table-responsive">
                    <table class="table table-hover m-0 table-actions-bar" id="dataTable">
                        <thead>
                            <tr>
                                <th width="5%">รูป</th>
                                <th>ชื่อผู้ใช้งาน</th>
                                <th>อีเมลผู้ใช้งาน</th> 
                                <th width="10%">สิทธิ์ผู้ใช้งาน</th>
                                <th width="10%">สถานะ</th>
                                <th width="25%">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($data as $key => $user)
                            <tr>
                                <td>
                                    @if(isset($user->images_name) && !empty($user->images_name))
                                    <div class="rounded-circle" style="background: url(<?php echo asset('/images/users') . '/' . $user->images_name; ?>); width: 50px; height: 50px;background-size: cover; background-position: center;"> </div>
                                    @else
                                    <img class="rounded-circle" src="{{ asset('/favicon.ico') }}" height="40">
                                    @endif
                                </td>
                                <td> {{ (isset($user->username))? $user->username : '' }} </td>
                                <td> {{ (isset($user->email))? $user->email : '' }} </td>
                                <td>
                                    @if(!empty($user->getRoleNames()))
                                    @foreach($user->getRoleNames() as $v)
                                    <span class="badge bg-dark p-1 mb-1">{{ $v }}</span>
                                    @endforeach
                                    @endif
                                </td>
                                <td> <?php echo helperStatusShow($user->status); ?> </td>
                                <td class="text-right">
                                    @can('user-edit')
                                    <a class="btn btn-dark waves-effect waves-light" href="{{ route('users.edit',$user->id) }}">แก้ไข</a>
                                    @endcan
                                    @can('user-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline', 'id' => 'delete-confirm2']) !!}
                                    {!! Form::submit('ลบข้อมูล', ['class' => 'btn btn-danger waves-effect waves-light delete-confirm']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table> 
                </div>
 
            </div>
        </div>
    </div>
</div>
@endsection
@section('script')
<script src="{{ asset('template/libs/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('template/libs/datatables/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('template/libs/datatables/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('template/libs/datatables/responsive.bootstrap4.min.js') }}"></script>
<script>
    datatable();

    function datatable() {
        var table = $('#dataTable').DataTable({
            "processing": false,
            "serverSide": false,
            "searching": true,
            "lengthChange": true,
            "order": [],
            "columnDefs": [{
                "targets": 0,
                "orderable": false,
            }, ],
            dom: "<'row'<'col-sm-6'B><'col-sm-6'f>>" +
                "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-4'i><'col-sm-4 text-center'l><'col-sm-4'p>>"
        });
    }
</script>
@endsection