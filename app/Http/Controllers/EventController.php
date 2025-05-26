<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        $events = Event::orderBy('date_debut', 'asc')->paginate(3);
        return view('events.index', compact('events'));
    }

    public function create()
    {
        return view('events.create');
    }

    public function store(EventRequest $request)
    {
        $data = $request->validated();

        if ($request->hasfile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }
        // dd($data);
        Event::create($data);

        return redirect()->route('events.index')->with('success', 'new event added successfully');
    }
}
