<?php

namespace App\Http\Controllers;

use App\Models\Species;
use Illuminate\Http\Request;

class SpeciesController extends Controller
{
    public function create()
    {
        $speciesList = Species::all();
        return view('admin.species.create', compact('speciesList'));
    }

    public function store(Request $request)
    {
        $fields = $request->validate([
            'name' => 'required|string|unique:species,name|max:255',
        ]);

        Species::create($fields);

        return redirect()->route('species.create')->with('success', 'Species added successfully!');
    }

    public function destroy(Species $species)
    {
        $species->delete();
        return back()->with('success', 'Species removed successfully!');
    }
}