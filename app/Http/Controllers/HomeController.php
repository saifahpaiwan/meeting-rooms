<?php

namespace App\Http\Controllers;

use App\Models\meeting_rooms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class HomeController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, $id = null)
    {
        $pageTitleItmas = [];    
        $pageName = "ปฏิทิน Timeline Booking";

        $users = User::where('status', 1)->get();  
        return view('home', compact('pageTitleItmas', 'pageName', 'users'));
    }

    public function SetSeletePlant(Request $request)
    {
        $request->session()->put("setSeletePlant", $request->id);
        return true;
    }
}
