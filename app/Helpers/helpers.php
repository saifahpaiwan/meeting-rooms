<?php

// #### หาวันที่ระหว่างวันที่เริ่มถึงสิ้นสุด #### //

use App\Models\employees_plant;
use App\Models\Notifications;
use Illuminate\Support\Facades\Auth;

if (!function_exists('helperDateDiff')) {
    function helperDateDiff($start_date, $end_date)
    {
        $start_date = new DateTime($start_date);
        $end_date = new DateTime($end_date);
        $interval = $start_date->diff($end_date);
        return $interval->format('%a วัน %H ชม. %i นาที');
    }
}

// #### แสดงสถานะด้วยรูปแบบ HTML Status #### //
if (!function_exists('helperStatusShow')) {
    function helperStatusShow($status)
    {
        $data = [
            0 => '<span class="badge badge-secondary p-1">Disable</span>',
            1 => '<span class="badge badge-success p-1">Enable</span>'
        ];

        return (isset($data[$status])) ? $data[$status] : null;
    }
}

// #### แสดงสถานะด้วยรูปแบบ HTML Approved #### //
if (!function_exists('helperStatusApproved')) {
    function helperStatusApproved($status)
    {
        $data = [
            'N' => '<span class="badge badge-warning p-1">ยังไม่อนุมัติ</span>',
            'Y' => '<span class="badge badge-success p-1">อนุมัติสำเร็จ</span>'
        ];

        return (isset($data[$status])) ? $data[$status] : null;
    }
}

// #### Count Notification #### //
if (!function_exists('helperCountNoti')) {
    function helperCountNoti()
    {
        $data = Notifications::where('recipient_id', Auth::user()->id)->where('status', 'N')->count();
        return $data;
    }
}
 
