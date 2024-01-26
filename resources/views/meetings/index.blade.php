@extends('layouts.app')
@section('style')
<link href="{{ asset('template/libs/datatables/dataTables.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/libs/datatables/buttons.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link href="{{ asset('template/libs/datatables/responsive.bootstrap4.css') }}" rel="stylesheet" type="text/css" />
<link rel="stylesheet" type="text/css" href="{{ asset('template/libs/datepicker/date-picker.css') }}">
@endsection
@section('content')
@include('include.page-title-box')

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="row mb-1">
                    <div class="col-md-6 responsive-mobile-title ">
                        <h4 class="header-title">ตารางข้อมูล{{ $pageName }} </h4>
                        <p class="sub-header"> ข้อมูลประจำวันที่ : {{ date('d M Y') }} </p>
                    </div>
                    <div class="col-md-6 text-right responsive-mobile-btn">
                        @can('meetings-create')
                        <a href="{{ route('meetings.create') }}" class="btn btn-primary waves-effect waves-light float-right mb-2">
                            <i class="fe-plus-square"></i> เพิ่มข้อมูล
                        </a>
                        @endcan
                    </div>
                </div>

                {!! Form::open(['route' => 'meetings.index', 'method'=>'GET', 'class' => 'mb-2']) !!}
                <div class="row">
                    <div class="col-md-3 form-group">
                        <input type="search" class="form-control" id="keyword" name="keyword" placeholder="ค้นหาหัวข้อการประชุม" value="{{ (isset($_GET['keyword']) && !empty($_GET['keyword']))? $_GET['keyword'] : '' }}">
                    </div>
                    <div class="col-md-3 form-group">
                        <input class="datepicker-here form-control digits" type="text" name="date" data-range="true" data-multiple-dates-separator=" - " data-language="en" data-bs-original-title="" title="" placeholder="ค้นหาตามวันที่ประชุม" autocomplete="off" value="{{ (isset($_GET['date']) && !empty($_GET['date']))? $_GET['date'] : '' }}">
                    </div>
                    <div class="col-md-2 form-group">
                        <select class="form-control" id="meeting_rooms_id" name="meeting_rooms_id">
                            <option value=""> Meeting Rooms </option>
                            @if(isset($meetingRooms) && count($meetingRooms)>0)
                            @foreach($meetingRooms as $row)
                            <option @if(old('meeting_rooms_id') && old('meeting_rooms_id')==$row->id)
                                {{ __("selected") }}
                                @else
                                @if(isset($data->meeting_rooms_id) && $data->meeting_rooms_id==$row->id) {{ __("selected") }} @endif
                                @endif

                                value="{{ $row->id }}"> {{ $row->name }}
                            </option>
                            @endforeach
                            @endif
                        </select>
                    </div>
                    <div class="col-md-2 form-group">
                        <select class="form-control" id="approved" name="approved">
                            <option value=""> สถานะการอนุมัติ </option>
                            <option {{ (isset($_GET['approved']) && $_GET['approved']=="N")? 'selected' : '' }} value="N"> ยังไม่อนุมัติ </option>
                            <option {{ (isset($_GET['approved']) && $_GET['approved']=="Y")? 'selected' : '' }} value="Y"> อนุมัติสำเร็จ </option>
                        </select>
                    </div>
                    <div class="col-md-2 form-group text-right">
                        <button class="btn btn-dark waves-effect waves-light" type="summit"><i class="fe-search"></i> ค้นหา</button>
                        <a href="{{ route('meetings.index') }}" class="btn btn-dark waves-effect waves-light"><i class="fe-rotate-cw"></i> รีเฟรช </a>
                    </div>
                </div>
                {!! Form::close() !!}

                <div class="table-responsive">
                    <table class="table table-hover m-0 table-actions-bar" id="dataTable">
                        <thead>
                            <tr>
                                <th width="10%"> สถานะการอนุมัติ </th>
                                <th width="20%"> วันที่ประชุม </th>
                                <th> หัวข้อการประชุม </th>
                                <th width="10%"> ผู้จองโดย </th>
                                <th width="15%"> Meeting Rooms </th>
                                <th width="10%"> เมื่อ </th>
                                <th width="15%">#</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if(isset($data) && count($data)>0)
                            @foreach ($data as $key => $row)
                            <tr>
                                <td> <?php echo helperStatusApproved($row->approved); ?> </td>
                                <td>
                                    <div> <strong>{{ date("d/m/Y", strtotime($row->start_time)) }} </strong> </div>
                                    {{ date("H:i", strtotime($row->start_time))." - ".date("H:i", strtotime($row->end_time))." น." }}
                                </td>
                                <td> {{ $row->title }} </td>
                                <td> {{ $row->rBooker?->email }} </td>
                                <td> {{ $row->rMeetingRooms?->name }} <i class="fas fa-circle" style="color: <?php echo $row->rMeetingRooms?->color; ?>;"></i></td>
                                <td> {{ date("d/m/Y H:i", strtotime($row->created_at)) }} น. </td>

                                <td class="text-right">
                                    @can('meetings-edit')
                                    <a class="btn btn-dark waves-effect waves-light" href="{{ route('meetings.edit',$row->id) }}">จัดการ</a>
                                    @endcan
                                    @can('meetings-delete')
                                    {!! Form::open(['method' => 'DELETE','route' => ['meetings.destroy', $row->id],'style'=>'display:inline', 'id' => 'delete-confirm2']) !!}
                                    {!! Form::submit('ลบข้อมูล', ['class' => 'btn btn-danger waves-effect waves-light delete-confirm']) !!}
                                    {!! Form::close() !!}
                                    @endcan
                                </td>
                            </tr>
                            @endforeach
                            @endif
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

<script src="{{ asset('template/libs/datepicker/datepicker.js') }}"></script>
<script src="{{ asset('template/libs/datepicker/datepicker.en.js') }}"></script>
<script src="{{ asset('template/libs/datepicker/datepicker.custom.js') }}"></script>
<script src="{{ asset('template/libs/datepicker/tooltip-init.js') }}"></script>
<script>
    $('#meeting_rooms_id').select2();
    $('#approved').select2();
    
    datatable();

    function datatable() {
        var table = $('#dataTable').DataTable({
            "processing": false,
            "serverSide": false,
            "searching": false,
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