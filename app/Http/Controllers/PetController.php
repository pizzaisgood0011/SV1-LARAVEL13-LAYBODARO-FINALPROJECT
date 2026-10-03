<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use App\Models\Species;
use Illuminate\Http\Request;

class PetController extends Controller
{
    public function index()
    {
        $pets = Pet::with('species')->latest()->get();
        return view('admin.dashboard', compact('pets'));
    }

    public function create()
    {
        $species = Species::all();
        return view('admin.pets.create', compact('species'));
    }

    public function store(Request $request){
        $fields = $request->validate([
            'species_id' => 'required|exists:species,id',
            'name'       => 'required|string|max:255',
            'age'        => 'required|integer|min:0',
            'status'     => 'required|in:Available,Adopted',
        ]);
        Pet::create($fields);
        return redirect()->route('dashboard')->with('success', 'Pet added successfully!');
    }

    public function show(Pet $pet)    {
        $pet->load('species');
        return view('pets.show', compact('pet'));
    }

    public function edit(Pet $pet){
        $species = Species::all();
        return view('admin.pets.edit', compact('pet', 'species'));
    }

    public function update(Request $request, Pet $pet){
        $fields = $request->validate([
            'species_id' => 'required|exists:species,id',
            'name'       => 'required|string|max:255',
            'age'        => 'required|integer|min:0',
            'status'     => 'required|in:Available,Adopted',
        ]);

        $pet->update($fields);

        return redirect()->route('dashboard')->with('success', 'Pet updated successfully!');
    }

    public function destroy(Pet $pet)
    {
        $pet->delete();
        return back()->with('success', 'Pet deleted successfully!');
    }
}