<input type="hidden" name="create_uid" value="{{ (isset(auth()->user()->id))? auth()->user()->id : '' }}">
<div class="row mb-2">
    <div class="col-md-2">
        <div class="form-group">
            <label for="color"> เลือกสี <span class="text-danger">*</span> </label>
            <input type="color" class="form-control @error('color') parsley-error @enderror" name="color" id="color" placeholder="Color" value="{{ (isset($data->color))? $data->color : old('color') }}">
            @error('color')
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $message }}</li>
            </ul>
            @enderror
        </div>
    </div>
    <div class="col-md-10">
        <div class="form-group">
            <label for="name"> ชื่อข้อมูล <span class="text-danger">*</span> </label>
            <input type="text" class="form-control @error('name') parsley-error @enderror" name="name" id="name" placeholder="Data Name." value="{{ (isset($data->name))? $data->name : old('name') }}">
            @error('name')
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $message }}</li>
            </ul>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
        <div class="form-group">
            <label for="description"> คำอธิบายเพิ่มเติม </label>
            <textarea class="form-control @error('description') parsley-error @enderror" rows="3" name="description" id="description" placeholder="Description.">{{ (isset($data->description))? $data->description : old('description') }}</textarea>
            @error('description')
            <ul class="parsley-errors-list filled">
                <li class="parsley-required">{{ $message }}</li>
            </ul>
            @enderror
        </div>
    </div>
    <div class="col-md-12">
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