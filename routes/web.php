<?php

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function (Request $request) {
    $data = DB::table('events')
        ->join('users', 'users.id', '=', 'events.org_id')
        ->select('events.*', 'users.fname');

    if($request->has('search')){
        $data->where('events.eventname', 'LIKE', "{$request->search}%");
    }
    if(($request->has('sdate'))&&($request->has('edate')))
    {
        $from = $request->sdate;
        $to = $request->edate;
        $data->whereBetween('events.start_date', [$from, $to]);
    }
    $event_data= $data->paginate(4);
    return view('welcome', compact('event_data'));
});
Route::get('/count', function () {
    $event_count = Event::count();
    $user_count = User::count();
    return view('count', compact('event_count','user_count'));
});
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('events','App\Http\Controllers\EventController');
Route::get('invite-event/{id}', [EventController::class, 'inviteEvent']);
Route::post('invitation-mail', [EventController::class, 'inviteMail']);
Route::get('invited/', [EventController::class, 'invitedmembers']);
Route::get('event-mebers/', [EventController::class, 'eventMembers']);
Route::get('remove-from-event/{id}', [EventController::class, 'removeFromEvent']);
