<?php

namespace App\Http\Controllers;
use App\Models\Event;
use App\Models\EventInvite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {

        $event_count = Event::latest()->where('org_id', Auth::user()->id)->count();
        $members_invite = EventInvite::where('org_id', Auth::user()->id)->where('status','invite')->count();
        $members_reject = EventInvite::where('org_id', Auth::user()->id)->where('status','reject')->count();
        return view('home', compact('event_count','members_invite','members_reject'));
    }

}
