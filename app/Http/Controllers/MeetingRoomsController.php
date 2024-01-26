<?php

namespace App\Http\Controllers;

use App\Models\meeting_rooms;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class MeetingRoomsController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:meeting-rooms-list|meeting-rooms-create|meeting-rooms-edit|meeting-rooms-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:meeting-rooms-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:meeting-rooms-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:meeting-rooms-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        ########################
        ### Page Title Itmas ###
        ########################
        $pageTitleItmas = [['name' => 'รายการห้องประชุม', 'url' => '#']];
        $pageName = "รายการห้องประชุม";

        $Query = meeting_rooms::query();
        if ($request->keyword) {
            $Query->where('name', 'like', "%$request->keyword%");
        }

        if ($request->status) {
            $status = ($request->status==-1)? '0' : $request->status;
            $Query->where('status', $status);
        }
  
        if ($request->date) {
            $explode = explode("-", $request->date);
            if (isset($explode[0]) && isset($explode[1])) {
                $from = date("Y-m-d 00:00:00", strtotime($explode[0]));
                $to = date("Y-m-d 23:59:59", strtotime($explode[1]));   
                $Query->whereBetween('created_at', [$from, $to]);
            } else if (isset($explode[0])) { 
                $from = date("Y-m-d 00:00:00", strtotime($explode[0]));
                $to = date("Y-m-d 23:59:59", strtotime($explode[0]));  
                $Query->whereBetween('created_at', [$from, $to]);
            }
        }

        $data = $Query->orderBy('id', 'DESC')->get();
        return view('meeting_rooms.index', compact('data', 'pageTitleItmas', 'pageName'));
    }

    public function create()
    {
        ########################
        ### Page Title Itmas ###
        ########################
        $pageName = "สร้างข้อมูลห้องประชุม";
        $pageTitleItmas = [
            ['name' => 'รายการห้องประชุม', 'url' => route('meeting-rooms.index')],
            ['name' => $pageName, 'url' => '#']
        ]; 
 
        return view('meeting_rooms.create', compact('pageTitleItmas', 'pageName'));
    }

    public function store(Request $request)
    {
        request()->validate([
            'color'    => 'required', 
            'name'     => 'required|string|max:255',
            'status'   => 'required|integer', 
        ]);
        meeting_rooms::create($request->all());
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | Meeting Room created Successfully : ' . json_encode($request->all(), true));
        return redirect()->route('meeting-rooms.index')->with('success', 'Meeting Room created Successfully.');
    }
 
    public function edit($id)
    {
        ########################
        ### Page Title Itmas ###
        ########################
        $pageName = "แก้ไขข้อมูลห้องประชุม";
        $pageTitleItmas = [
            ['name' => 'รายการห้องประชุม', 'url' => route('meeting-rooms.index')],
            ['name' => $pageName, 'url' => '#']
        ];

        $data = meeting_rooms::find($id);
        return view('meeting_rooms.edit', compact('data', 'pageTitleItmas', 'pageName'));
    }

    public function update(Request $request, $id)
    {
        request()->validate([
            'color'   => 'required', 
            'name' => 'required|string|max:255',
            'status'   => 'required|integer', 
        ]);
        $data = meeting_rooms::find($id);
        $data->update($request->all());
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | Meeting Room updated Successfully : ' . json_encode($request->all(), true));
        return back()->with('success', 'Meeting Room updated Successfully');
    }

    public function destroy($id)
    {
        $data = meeting_rooms::find($id);
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | Meeting Room destroy Successfully : ' . json_encode($data, true));
        $data->delete();
        return redirect()->route('meeting-rooms.index')->with('success', 'Meeting Room destroy Successfully');
    } 
}
