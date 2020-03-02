<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\UserToEvent;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class EventWebController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('events.eventsList', [
            'title' => 'Новости',
            'events' => Event::all()->sortByDesc('created_at')
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('events.eventCreate', [
            'title' => 'Добавить мероприятие'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->event_head = trim($request->event_head);
        $request->event_body = trim($request->event_body);

        $validator = Validator::make($request->all(), [
            'event_head' => 'required|min:3|max:191|string',
            'event_body' => 'required|min:3|max:100000',
            'event_date' => 'required|date',
            'event_place' => 'required|min:3|max:191|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.events.create')
                ->withErrors($validator)
                ->withInput();
        }

        Event::create([
            'uuid' => Str::uuid(),
            'head' => $request->input('event_head'),
            'body' => $request->input('event_body'),
            'date_start' => $request->input('event_date'),
            'place' => $request->input('event_place')
        ]);

        return redirect()->route('auth.events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $users = UserToEvent::where('event_id', '=', $id)->get();
        $clients = [];
        foreach($users as $user)
        {
            $i = $user->user();
            $clients[] = [
                'name' => $i->name,
                'email' => $i->email,
                'phone' => $user->phone,
                'org' => $user->org,
            ];
        };
        return view('events.eventDetail', [
            'title' => 'Информация о мероприятии',
            'event' => Event::where('id', '=', $id)->first(),
            'users' => $clients
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        UserToEvent::where('event_id', '=', $request->id)->delete();
        Event::where('id', '=', $request->id)->delete();
        return response()->json(['succses'=>'Удалено'], 200); 
    }

            /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $event = Event::where('id', $id)->first();
        return view('events.eventEdit', [
            'title' => 'Редактировать событие',
            'id' => $id,
            'event' => $event
        ]);
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
        $request->event_head = trim($request->event_head);
        $request->event_body = trim($request->event_body);

        $validator = Validator::make($request->all(), [
            'event_head' => 'required|min:3|max:191|string',
            'event_body' => 'required|min:3|max:100000',
            'event_date' => 'required|date',
            'event_place' => 'required|min:3|max:191|string',
        ]);

        if ($validator->fails()) {
            return redirect()
                ->route('auth.events.edit', ['id' => $id])
                ->withErrors($validator)
                ->withInput();
        }

        Event::where('id', $id)->update([
            'head' => $request->input('event_head'),
            'body' => $request->input('event_body'),
            'date_start' => $request->input('event_date'),
            'place' => $request->input('event_place')
        ]);

        return redirect()->route('auth.events.index');
    }
}
