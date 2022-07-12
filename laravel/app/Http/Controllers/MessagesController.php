<?php

namespace App\Http\Controllers;

use App\Models\Message;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Session;

class MessagesController extends Controller
{

    public function feedback($data)
    {

        $feedback = (array) json_decode($data);

        if (isset($feedback["sentiment"])) {

            define("ID", DB::table("feedback")
                    ->insertGetId($feedback));
            return ID;

        } else {

            $id = array_pop($feedback);

            DB::table("feedback")
                ->where("id", $id)
                ->update($feedback);
                
                return $id;

        }

    }

    /**
     * Show all of the message threads to the user.
     *
     * @return mixed
     */
    public function index()
    {
        $id = auth()->user()->id;
        $user = User::find($id);

        $subs = DB::table('subscriptions')
            ->join('users', 'subscriptions.creator_id', '=', 'users.id')
            ->where('subscriptions.user_id', '=', $id)
            ->where('subscriptions.status', '=', 1)
            ->select('users.*')
            ->get();

        $trevor = User::find(1);

        return view('messenger.index', compact('user', $user))
            ->with('subs', $subs)
            ->with('trevor', $trevor);
    }

    /**
     * Shows a message thread.
     *
     * @param $id
     * @return mixed
     */
    private function show($id)
    {
        try {
            $thread = Message::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }
        $id = auth()->user()->id;
        $user = User::find($id);

        return view('messenger.show', compact('user', $user))
            ->with('thread', $thread)
            ->with('subs', $subs);
    }

    /**
     * Creates a new message thread.
     *
     * @return mixed
     */
    public function create()
    {
        $id = auth()->user()->id;
        $user = User::find($id);
        $trevor = User::find(1);
        return view('messenger.create', compact('user', $user))
            ->with('trevor', $trevor);
    }

    /**
     * Stores a new message thread.
     *
     * @return mixed
     */
    public function store()
    {
        $input = Request::all();

        $thread = Thread::create([
            'subject' => $input['subject'],
        ]);

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => $input['message'],
        ]);

        // Sender
        Participant::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'last_read' => new Carbon(),
        ]);

        // Recipients
        if (Request::has('recipients')) {
            $thread->addParticipant($input['recipients']);
        }

        return redirect()->route('messages');
    }

    /**
     * Adds a new message to a current thread.
     *
     * @param $id
     * @return mixed
     */
    public function update($id)
    {
        try {
            $thread = Thread::findOrFail($id);
        } catch (ModelNotFoundException $e) {
            Session::flash('error_message', 'The thread with ID: ' . $id . ' was not found.');

            return redirect()->route('messages');
        }

        $thread->activateAllParticipants();

        // Message
        Message::create([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
            'body' => Request::input('message'),
        ]);

        // Add replier as a participant
        $participant = Participant::firstOrCreate([
            'thread_id' => $thread->id,
            'user_id' => Auth::id(),
        ]);
        $participant->last_read = new Carbon();
        $participant->save();

        // Recipients
        if (Request::has('recipients')) {
            $thread->addParticipant(Request::input('recipients'));
        }

        return redirect()->route('messages.show', $id);
    }
}
