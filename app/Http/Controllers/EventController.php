<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Event;
use App\Models\User;
use Illuminate\Http\Request;

class EventController extends Controller
{
    // Admin : afficher tous les événements avec filtre par user
    public function adminIndex(Request $request)
    {
        $users = User::where('userType', 'user')->get();
        $query = Event::with('user')->orderBy('user_id', 'asc');

        if ($request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        $events = $query->paginate(10);

        return view('admin.events.index', compact('events', 'users'));
    }


    public function userIndex(Request $request)
    {
        $query = Event::where('user_id', auth()->id());

        if ($request->date_debut) {
            $query->whereDate('date_debut', $request->date_debut);
        }

        $events = $query->orderBy('date_debut')->paginate(10);

        return view('user.events.index', compact('events'));
    }


    public function create()
    {
        if (auth()->user()->userType === 'admin') {
            return view('admin.events.create');
        } else {
            return view('user.events.create');
        }
    }



    public function store(EventRequest $request)
    {
        $data = $request->validated();
        $data['user_id'] = auth()->id(); // Associe l'utilisateur connecté

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('images', 'public');
        }

        Event::create($data);

        if (auth()->user()->userType === 'admin') {
            return redirect()->route('admin.index')->with('success', 'Événement ajouté avec succès');
        } else {
            return redirect()->route('events.index')->with('success', 'Événement ajouté avec succès');
        }
    }
}
