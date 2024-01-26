<?php

namespace App\Http\Controllers;

use App\Models\Notifications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Throwable;

class NotificationsController extends Controller
{
    public function index()
    {
        $notifications = Notifications::latest()->where('recipient_id', Auth::user()->id)->orderBy('status', 'asc')->paginate(5);
        return view('notifications.index', compact('notifications'))
            ->with('i', (request()->input('page', 1) - 1) * 5);
    }
 
    public function show($id)
    {
        $notifications = Notifications::where('recipient_id', $id)->orderBy('id', 'DESC')->get();
        $items = []; 
        foreach ($notifications as $row) {
            $items[$row->id]['id'] = $row->id;
            $items[$row->id]['sender']    = (isset($row->sender_r->rPlant->plant))? $row->sender_r->rPlant->plant." | ".$row->sender_r->username : $row->sender_r->username;
            $items[$row->id]['recipient'] = (isset($row->recipient_r->rPlant->plant))? $row->recipient_r->rPlant->plant." | ".$row->recipient_r->username : $row->recipient_r->username;
            $items[$row->id]['message'] = $row->notiType_r->name;
            $items[$row->id]['color'] = $row->notiType_r->color;
            $items[$row->id]['icon']  = $row->notiType_r->icon;
            $items[$row->id]['url'] = url($row->url);
            $items[$row->id]['status'] = $row->status;
            $items[$row->id]['created_at'] = Carbon::parse($row->created_at)->diffForHumans();
            $items[$row->id]['updated_at'] = (!empty($row->updated_at)) ? Carbon::parse($row->updated_at)->diffForHumans() : null;
        } 
        if (isset($notifications) && count($notifications) > 0) {
            rsort($items);
            return response()->json($items, 200);
        }
    }
 
    public function update(Request $request, $id)
    {
        $data = [];
        $data['status']     = "Y";
        $data['updated_at'] = new \DateTime();
        DB::table('notifications')
            ->where('id', $id)
            ->update($data); 
        Log::info('username : ' . auth()->user()->username . ' IP : ' . request()->ip() . ' | Open notification list : ' . json_encode($request->all(), true));
        return "success";
    }

    public function destroy($id)
    {
        $notifications = Notifications::find($id); 
        Log::info('username : ' . auth()->user()->username . ' IP : ' . request()->ip() . ' | Notifications deleted successfully : ' . json_encode($notifications, true));
        $notifications->delete(); 
        return back()->with('success', 'Notifications deleted successfully.');
    }
}