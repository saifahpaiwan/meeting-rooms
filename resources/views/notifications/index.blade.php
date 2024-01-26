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
                    <li class="breadcrumb-item active">การแจ้งเตือน</li>
                </ol>
            </div>
            <h4 class="page-title"> การแจ้งเตือน </h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">การแจ้งเตือน </h4>
                <p class="sub-header">
                    ข้อมูลประจำวันที่ {{ date('d M Y') }}
                </p>

                @if ($message = Session::get('success'))
                <div class="alert alert-success text-success alert-dismissible fade show">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                    <i class="mdi mdi-check-all mr-2"></i> {{ $message }}
                </div>
                @endif

                {!! Form::open(['route' => 'notifications.index', 'method'=>'GET', 'class' => 'mb-2']) !!}
                <div class="row">
                    <div class="col-md-10 form-group">
                        <input type="search" class="form-control" id="keyword" name="keyword" placeholder="ค้นหาข้อมูลเพิ่มเติม....">
                    </div>
                    <div class="col-md-2 form-group text-right">
                        <button class="btn btn-dark waves-effect waves-light ml-1" type="summit"><i class="fe-search"></i> ค้นหา</button>
                        <a href="{{ route('notifications.index') }}" class="btn btn-dark waves-effect waves-light ml-1"><i class="fe-rotate-cw"></i> รีเฟรช </a>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                    <table class="table table-hover m-0 table-actions-bar">

                        <tr>
                            <th>ลำดับ</th>
                            <th width="50%">ข้อความ</th>
                            <th>ผู้ส่ง</th>
                            <th>ผู้รับ</th>
                            <th>สถานะ</th>
                            <th>เวลา</th>
                            <th></th>
                        </tr>

                        @foreach ($notifications as $key => $notification)
                        <tr>
                            <td>{{ ++$i }}</td>
                            <td>{{ $notification->notiType_r?->name }}</td>
                            <td>{{ $notification->sender_r?->username }}</td>
                            <td>{{$notification->recipient_r?->username }}</td>
                            <td>
                                <?php
                                echo ($notification->status == "Y") ? '<span class="badge badge-success p-1">อ่านแล้ว</span>' : '<span class="badge badge-danger p-1">ยังไม่อ่าน</span>';
                                ?>
                            </td>
                            <td>{{ (!empty($notification->updated_at))? $notification->updated_at : $notification->created_at }}</td>
                            <td>
                                <a href="javascript: void(0);" class="btn btn-dark waves-effect waves-light notify-read" data-id="{{ $notification->id }}" data-url="{{ $notification->url }}">
                                    ดูรายการ
                                </a>
                                {!! Form::open(['method' => 'DELETE','route' => ['notifications.destroy', $notification->id], 'style'=>'display:inline', 'id' => 'delete-confirm2']) !!}
                                {!! Form::submit('ลบข้อมูล', ['class' => 'btn btn-danger waves-effect waves-light delete-confirm']) !!}
                                {!! Form::close() !!}
                            </td>
                        </tr>
                        @endforeach
                    </table>

                </div>

                {!! $notifications->render() !!}

            </div>
        </div>
    </div>
</div>
@endsection