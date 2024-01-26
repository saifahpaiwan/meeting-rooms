<div class="row mb-2">
    <div class="col-md-8">
        <div class="form-group">
            <label for="title"> หัวข้อการประชุม <span class="text-danger">*</span> </label>
            <input type="text" class="form-control @error('title') parsley-error @enderror" name="title" id="title" placeholder="Meeting topic." value="{{ (isset($data->title))? $data->title : old('title') }}">
            @error('title')
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $message }}</li>
            </ul>
            @enderror
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="booker_id"> ผู้จอง <span class="text-danger">*</span> </label>
            <select class="form-control @error('booker_id') parsley-error @enderror" id="booker_id" name="booker_id">
                <option value=""> โปรดเลือกข้อมูล </option>
                @if(isset($users) && count($users)>0)
                @foreach($users as $row)
                <option @if(old('booker_id') && old('booker_id')==$row->id)
                    {{ __("selected") }}
                    @else
                    @if(isset($data->booker_id) && $data->booker_id==$row->id) {{ __("selected") }} @endif
                    @endif

                    value="{{ $row->id }}"> {{ $row->email }}
                </option>
                @endforeach
                @endif
            </select>
            @error('booker_id')
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $message }}</li>
            </ul>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="send_to"> ผู้เข้าร่วมการประชุม <span class="text-danger">*</span> </label>
            <div class="tags-default">
                <input type="text" value="{{ (isset($data->send_to))? $data->send_to : old('send_to') }}" class="form-control @error('send_to') parsley-error @enderror" name="send_to" id="send_to" placeholder="Add Meeting Participants" />
            </div>

            @error('send_to')
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $message }}</li>
            </ul>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="description"> คำอธิบายการประชุม </label>
            <textarea class="form-control @error('description') parsley-error @enderror" rows="3" name="description" id="description" placeholder="Description.">{{ (isset($data->description))? $data->description : old('description') }}</textarea>
            @error('description')
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $message }}</li>
            </ul>
            @enderror
        </div>
    </div>

</div>

<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    $start_time = date('Y-m-d\TH:i', strtotime(date('Y-m-d H:i:s')));
                    if (isset($data->start_time) && !empty($data->start_time)) {
                        $start_time = date('Y-m-d\TH:i', strtotime($data->start_time));
                    }
                    if (old('start_time')) {
                        $start_time = date('Y-m-d\TH:i', strtotime(old('start_time')));
                    }
                    ?>
                    <label for="start_time"> วันเวลาที่เริ่มการประชุม (Strat Datetime) <span class="text-danger">*</span> </label>
                    <input type="datetime-local" class="form-control @error('start_time') parsley-error @enderror" id="start_time" name="start_time" value="{{ $start_time }}" min="{{ date('Y') }}-01-01" max="{{ (date('Y')+5) }}-12-31" />
                    @error('start_time')
                    <ul class="parsley-errors-list filled">
                        <li class="parsley-required">{{ $message }}</li>
                    </ul>
                    @enderror
                </div>
            </div>
            <div class="col-md-12">
                <div class="form-group">
                    <?php
                    $end_time = date('Y-m-d\TH:i', strtotime(date('Y-m-d H:i:s')));
                    if (isset($data->end_time) && !empty($data->end_time)) {
                        $end_time = date('Y-m-d\TH:i', strtotime($data->end_time));
                    }
                    if (old('end_time')) {
                        $end_time = date('Y-m-d\TH:i', strtotime(old('end_time')));
                    }
                    ?>
                    <label for="end_time"> วันเวลาที่สิ้นสุดการประชุม (End Datetime) <span class="text-danger">*</span> </label>
                    <input type="datetime-local" class="form-control @error('end_time') parsley-error @enderror" id="end_time" name="end_time" value="{{ $end_time }}" min="{{ date('Y') }}-01-01" max="{{ (date('Y')+5) }}-12-31" />
                    @error('end_time')
                    <ul class="parsley-errors-list filled">
                        <li class="parsley-required">{{ $message }}</li>
                    </ul>
                    @enderror
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <label for="allday"> Meeting Rooms <span class="text-danger">*</span></label>
        <select class="form-control @error('meeting_rooms_id') parsley-error @enderror" id="meeting_rooms_id" name="meeting_rooms_id">
            <option value=""> โปรดเลือกข้อมูล </option>
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
        @error('meeting_rooms_id')
        <ul class="parsley-errors-list filled">
            <li class="parsley-required">{{ $message }}</li>
        </ul>
        @enderror
    </div>
    <div class="col-md-4">
        <label for="allday"> สร้างการประชุมทุกวันที่กำหนดหรือไม่ ? </label>
        <div class="checkbox">
            <input id="allday" name="allday" type="checkbox" value="Y" @if(isset($data->allday) && $data->allday=="Y") {{ __("checked") }} @endif>
            <label for="allday"> All Day</label>
        </div>
    </div>
</div>

<div class="row">
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
        </div>
    </div>
</div>