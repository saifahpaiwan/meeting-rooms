<?php

namespace App\Http\Controllers;

use App\Models\meeting_rooms;
use App\Models\meetings;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeetingsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:meetings-list|meetings-create|meetings-edit|meetings-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:meetings-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:meetings-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:meetings-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        ########################
        ### Page Title Itmas ###
        ########################
        $pageTitleItmas = [['name' => 'รายการการประชุม', 'url' => '#']];
        $pageName = "รายการการประชุม";

        $Query = meetings::query();
        if ($request->keyword) {
            $Query->where('title', 'like', "%$request->keyword%");
        }

        if ($request->meeting_rooms_id) { 
            $Query->where('meeting_rooms_id', $request->meeting_rooms_id);
        }

        if ($request->approved) { 
            $Query->where('approved', $request->approved);
        }
  
        if ($request->date) {
            $explode = explode("-", $request->date);
            if (isset($explode[0]) && isset($explode[1])) {
                $from = date("Y-m-d 00:00:00", strtotime($explode[0]));
                $to = date("Y-m-d 23:59:59", strtotime($explode[1]));   
                $Query->whereBetween('start_time', [$from, $to]);
            } else if (isset($explode[0])) { 
                $from = date("Y-m-d 00:00:00", strtotime($explode[0]));
                $to = date("Y-m-d 23:59:59", strtotime($explode[0]));  
                $Query->whereBetween('start_time', [$from, $to]);
            }
        }

        $data = $Query->orderBy('id', 'DESC')->get();
        $meetingRooms = meeting_rooms::where('status', 1)->get(); 
        return view('meetings.index', compact('data', 'pageTitleItmas', 'pageName', 'meetingRooms'));
    }

    public function create()
    {
        ########################
        ### Page Title Itmas ###
        ########################
        $pageName = "สร้างข้อมูลการประชุม";
        $pageTitleItmas = [
            ['name' => 'รายการการประชุม', 'url' => route('meetings.index')],
            ['name' => $pageName, 'url' => '#']
        ]; 

        $users = User::where('status', 1)->get(); 
        $meetingRooms = meeting_rooms::where('status', 1)->get(); 
        return view('meetings.create', compact('pageTitleItmas', 'pageName', 'users', 'meetingRooms'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'title'     => 'required|string|max:255',
            'meeting_rooms_id'    => 'required|integer', 
            'booker_id'   => 'required|integer', 
            'send_to'   => 'required', 
            'start_time'   => 'required', 
            'end_time'   => 'required',   
        ]);

        $input = $request->all();
        $input['allday'] = (isset($request->allday) && $request->allday=="Y")? "Y" : "N";
        meetings::create($input);
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | Meeting Room created Successfully : ' . json_encode($request->all(), true));
        return redirect()->route('meetings.index')->with('success', 'Meeting Room created Successfully.');
    }
 
    public function edit($id)
    {
        ########################
        ### Page Title Itmas ###
        ########################
        $pageName = "แก้ไขข้อมูลการประชุม";
        $pageTitleItmas = [
            ['name' => 'รายการการประชุม', 'url' => route('meetings.index')],
            ['name' => $pageName, 'url' => '#']
        ];

        $data = meetings::find($id);
        $users = User::where('status', 1)->get(); 
        $meetingRooms = meeting_rooms::where('status', 1)->get(); 
        return view('meetings.edit', compact('data', 'pageTitleItmas', 'pageName', 'users', 'meetingRooms'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'title'     => 'required|string|max:255',
            'meeting_rooms_id'    => 'required|integer', 
            'booker_id'   => 'required|integer', 
            'send_to'   => 'required', 
            'start_time'   => 'required', 
            'end_time'   => 'required',   
        ]);  

        $data = meetings::find($id);
        $input = $request->all();
        $input['allday'] = (isset($request->allday) && $request->allday=="Y")? "Y" : "N";
        $data->update($input);
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | Meeting Room updated Successfully : ' . json_encode($request->all(), true));
        return back()->with('success', 'Meeting Room updated Successfully');
    }

    public function destroy($id)
    {
        $data = meetings::find($id);
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | Meeting Room destroy Successfully : ' . json_encode($data, true));
        $data->delete();
        return redirect()->route('meetings.index')->with('success', 'Meeting Room destroy Successfully');
    } 


    public function GetMeeting()
    {  
        $meetingRooms = meeting_rooms::where('status', 1)->get();
        $meetingRoomsitems =[];

        if(isset($meetingRooms) && count($meetingRooms)>0){
            foreach($meetingRooms as $key => $row){ 
                $meetingRoomsitems[$key]['id']    = $row->id;
                $meetingRoomsitems[$key]['name']  = $row->name;
                $meetingRoomsitems[$key]['color'] = $row->color; 
            }
        }

        $meetingsQuery = meetings::query(); 
        $booking = $meetingsQuery->orderBy('id', 'DESC')->get();
        if(isset($booking) && count($booking)>0){
            foreach($booking as $key => $row){ 
                $itemsBooking[$key]['start']    = date('Y-m-d\TH:i', strtotime($row->start_time));
                $itemsBooking[$key]['end']      = date('Y-m-d\TH:i', strtotime($row->end_time));
                $itemsBooking[$key]['title']    = $row->title; 
                $itemsBooking[$key]['resource'] = $row->rMeetingRooms?->id;  
            }
        }

        $data = [
            "resources" => $meetingRoomsitems,
            "data"      => $itemsBooking
        ];  
        return response()->json($data, 202);
    }
}
