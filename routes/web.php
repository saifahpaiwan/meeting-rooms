<?php 
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MeetingRoomsController;
use App\Http\Controllers\MeetingsController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\RoleController; 
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
 
Route::get('/', function () {
    return view('auth.login');
});
 

Auth::routes();
Route::get('/home/{id?}', [HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('roles', RoleController::class);
    Route::resource('users', UserController::class);  
    Route::post('get-users', [UserController::class, 'GetUsers'])->name('get.users');
    
    Route::resource('notifications', NotificationsController::class);
    Route::resource('meeting-rooms', MeetingRoomsController::class);  
    Route::resource('meetings', MeetingsController::class);


    Route::get('get-meeting-timeline', [MeetingsController::class, 'GetMeeting'])->name('get.meeting.timeline');
});
