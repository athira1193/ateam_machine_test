<?php

namespace App\Http\Controllers;

use App\Models\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use DataTables;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Models\EventInvite;
class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events = Event::latest()->get();
        if ($request->ajax()) {
            $event = Event::latest()->where('org_id', Auth::user()->id)->get();
            return Datatables::of($event)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    $btn = '<a href="invite-event/' . $row->id . '" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-success btn-sm editPost">Invite User</a>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('event', ['event'=>$events]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('event_create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = new Event();
        $event->eventname = $request->event_name;
        $event->start_date = $request->start_date;
        $event->end_date = $request->end_date;
        $event->venue = $request->venue;
        $event->status = 'active';
        $event->org_id =  Auth::user()->id;
        $event->save();
        return response()->json(['success'=>'Event saved successfully.']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function inviteEvent($id)
    {
        $events = Event::where('id', $id)->first();
        return view('event_mail', ['events'=>$events]);
    }
    public function inviteMail(Request $request)
    {
        $event_data = DB::table('events')
            ->join('users', 'users.id', '=', 'events.org_id')
            ->select('events.*', 'users.fname','users.id as organ_id')
            ->where('events.id', '=', $request->event_id)
            ->first();

            $details = [
            'candidate_name' => $request->sender_name,
            'candidate_email' => $request->sender_email,
            'event_name' => $event_data->eventname,
            'start_date' => $event_data->start_date,
            'end_date' => $event_data->end_date,
            'organizer' => $event_data->fname,
            'venue' => $event_data->venue
        ];
         $sender_data = [
             'candidate_name' => $request->sender_name,
             'candidate_email' => $request->sender_email
         ];
        $invite_candidate = new EventInvite();
        $invite_candidate->event_id = $event_data->id;
        $invite_candidate->org_id = $event_data->organ_id;
        $invite_candidate->email = $request->sender_email;
        $invite_candidate->status = 'invite';
        $invite_candidate->save();
        Mail::send('emails.InvitationMail', $details, function ($message)use($sender_data){

            $message->to($sender_data['candidate_email'], 'Receiver Name');
            $message->subject('Event Invitation form ATEAM');
            $message->from('athira1193@gmail.com', 'ATEAM');
        });
        return response()->json(['success'=>'Invitation sent successfully.']);
    }
    public function invitedmembers()
    {
        $members = EventInvite::where('org_id', Auth::user()->id)->get();
        return view('invited_member_list', ['members'=>$members]);
    }
    public function eventMembers(Request $request)
    {
        $mebers = DB::table('event_invites')
            ->join('events', 'events.id', '=', 'event_invites.event_id')
            ->select('event_invites.*', 'events.eventname')
            ->where('event_invites.org_id', Auth::user()->id)
            ->get();
        if ($request->ajax()) {
            $event = DB::table('event_invites')
                ->join('events', 'events.id', '=', 'event_invites.event_id')
                ->select('event_invites.*', 'events.eventname')
                ->where('event_invites.org_id', Auth::user()->id)
                ->get();
            return Datatables::of($event)
                ->addIndexColumn()
                ->addColumn('action', function($row){
                    if($row->status == 'invite')
                    {
                        $btn = '<a href="remove-from-event/' . $row->id . '" data-toggle="tooltip"  data-original-title="Edit" class="edit btn btn-danger btn-sm editPost">Reject</a>';
                    }
                    else
                    {
                        $btn = '<span style="background-color: red;color: white;padding: 5px;">Removed from Event</span>';
                    }
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('invited_member_list', ['mebers'=>$mebers]);
    }
    public function removeFromEvent($id)
    {
        $invite_event = EventInvite::where('id', $id)->first();
        $event_name = Event::where('id', $invite_event->event_id)->first();
        $details = [
            'candidate_email' => $invite_event->email,
            'event_name' => $event_name->eventname,
        ];
        EventInvite::where('id', $id)
            ->update([
                'status' => 'reject'
            ]);
        Mail::send('emails.RejectionMail', $details, function ($message)use($invite_event){

            $message->to($invite_event->email, 'Receiver Name');
            $message->subject('Event Rejection form ATEAM');
            $message->from('athira1193@gmail.com', 'ATEAM');
        });
        return redirect()->back();
    }
}
