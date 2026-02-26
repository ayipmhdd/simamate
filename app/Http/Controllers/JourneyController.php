<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Journey;
use Illuminate\Support\Facades\Auth;

class JourneyController extends Controller
{
    public function index()
    {
        $journeys = Journey::where('user_id', Auth::id())->latest('log_date')->get();
        return view('features.journey.index', compact('journeys'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'location_name' => 'required|string|max:255',
            'latitude' => 'required|numeric',
            'longitude' => 'required|numeric',
            'log_date' => 'required|date',
            'note' => 'nullable|string',
            'image' => 'nullable|image|max:2048'
        ]);

        $photoPath = null;
        if ($request->hasFile('image')) {
            $photoPath = $request->file('image')->store('journeys', 'public');
        }

        Journey::create([
            'user_id' => Auth::id(),
            'location_name' => $request->location_name,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'log_date' => $request->log_date,
            'note' => $request->note,
            'photo_path' => $photoPath,
        ]);

        return redirect()->route('journey.index')->with('success', 'Titik perjalanan berhasil ditambahkan!');
    }
}
