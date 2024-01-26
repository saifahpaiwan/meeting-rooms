<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller; 
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Log; 

class UserController extends Controller
{
    function __construct()
    {
        $this->middleware('permission:user-list|user-create|user-edit|user-delete', ['only' => ['index', 'store']]);
        $this->middleware('permission:user-create', ['only' => ['create', 'store']]);
        $this->middleware('permission:user-edit', ['only' => ['edit', 'update']]);
        $this->middleware('permission:user-delete', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        $perPage = ($request->per_page) ? $request->per_page : 10;

        $query = User::query();
        if ($request->keyword) {
            $query->where('username', 'like', "%$request->keyword%")
                ->orWhere('email', 'like', "%$request->keyword%")
                ->orWhere('phone', 'like', "%$request->keyword%");
        }

        if ($request->status) {
            $query->where('status', $request->status);
        }

        $data = $query->orderBy('id', 'DESC')->get();
        return view('users.index', compact('data'));
    }

    public function create()
    {
        $roles = Role::pluck('name', 'name')->all();
        return view('users.create', compact('roles'));
    }

    public function store(Request $request)
    {
        $validate = [ 
            'username' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|same:confirm-password',
            'roles' => 'required',
        ];

        if ($request->file('images_name')) {
            $validate['images_name'] = 'image|max:2048||mimes:jpeg,png,jpg';
        }

        request()->validate($validate);

        $file_name = null;
        if ($request->file('images_name')) {
            if (!empty($request->file('images_name'))) {
                $uploade_location = 'images/users/';
                $file = $request->file('images_name');
                $file_gen = hexdec(uniqid());
                $file_ext = strtolower($file->getClientOriginalExtension());
                $file_name = $file_gen . '.' . $file_ext;
                $file->move($uploade_location, $file_name);
            }
        }

        $input = $request->all();
        $input['password'] = Hash::make($input['password']);
        $input['images_name'] = $file_name;
        $user = User::create($input);
        $user->assignRole($request->input('roles')); 
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | User created successfully  : ' . json_encode($request->all(), true));
        return redirect()->route('users.index')->with('success', 'User created successfully');
    }

    public function GetUsers(Request $request)
    {
        $users = User::where('status', 1)->get();
        $items = [];
        if(isset($users)){
            foreach($users as $row){
                $items[] = $row->email;
            }
        }
        return response()->json($items, 202);
    }

    public function edit($id)
    {
        $redirect = (isset($_GET['rd'])) ? $_GET['rd'] : null;
        $data = User::find($id);
        $roles = Role::pluck('name', 'name')->all();
        $userRole = $data->roles->pluck('name', 'name')->all(); 
        return view('users.edit', compact('data', 'roles', 'userRole', 'redirect'));
    }

    public function update(Request $request, $id)
    { 
        $validate = [ 
            'username'      => 'required|string|max:255',
            'email'         => 'required|email|unique:users,email,' . $id,
            'password'      => 'same:confirm-password',
        ];

        if (!empty($request->roles)) {
            $validate['roles'] = 'required';
        }

        if ($request->file('images_name')) {
            $validate['images_name'] = 'image|max:2048||mimes:jpeg,png,jpg';
        }

        request()->validate($validate);


        $users = User::find($id);
        $file_name = $users->images_name;
        if ($request->file('images_name')) {
            if (!empty($request->file('images_name'))) {
                $uploade_location = 'images/users/';
                if (isset($users->images_name) && !empty($users->images_name)) {
                    @unlink($uploade_location . $users->images_name);
                }
                $file = $request->file('images_name');
                $file_gen = hexdec(uniqid());
                $file_ext = strtolower($file->getClientOriginalExtension());
                $file_name = $file_gen . '.' . $file_ext;
                $file->move($uploade_location, $file_name);
            }
        }

        $input = $request->all();
        if (!empty($input['password'])) {
            $input['password'] = Hash::make($input['password']);
        } else {
            $input = Arr::except($input, array('password'));
        }
        $input['images_name'] = $file_name;
        $users->update($input);

        if (!empty($request->roles)) {
            DB::table('model_has_roles')->where('model_id', $id)->delete();
            $users->assignRole($request->input('roles'));
        } 
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | User updated successfully  : ' . json_encode($request->all(), true));

        $redirect = (isset($request->redirect) && !empty($request->redirect)) ? 'home' : 'users.index';
        return redirect()->route($redirect)
            ->with('success', 'User updated successfully');
    }

    public function destroy($id)
    {
        $users = User::find($id);
        Log::info('username : '.auth()->user()->username.' IP : '. request()->ip().' | User destroy successfully  : ' . json_encode($users, true));
        $uploade_location = 'images/users/';
        if (!empty($users->images_name)) {
            @unlink($uploade_location . $users->images_name);
        }
        $users->delete(); 
        return redirect()->route('users.index')
            ->with('success', 'User deleted successfully');
    }
}
