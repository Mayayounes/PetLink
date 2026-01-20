<?php

namespace App\Http\Controllers;

use App\Models\Pet;
use Illuminate\Http\Request;

class PetController extends Controller
{
public function index(Request $request)
{
    $userId = auth()->id() ?? 1; // fallback for testing

    // Get adopted pets info
    $adoptedPetIds = \App\Models\Adoption::pluck('pet_id')->toArray(); // all adopted pets
    $userAdoptedPetIds = \App\Models\Adoption::where('user_id', $userId)->pluck('pet_id')->toArray(); // for current user

    // Start query for pets
    $query = Pet::query();

    // Filter by species/category
    if ($request->has('species') && is_array($request->species)) {
        $query->whereIn('category', $request->species);
    }

    // Filter by gender
    if ($request->has('gender') && is_array($request->gender)) {
        $query->whereIn('gender', $request->gender);
    }

    // Filter by age ranges
    if ($request->has('age') && is_array($request->age)) {
        $query->where(function($q) use ($request) {
            foreach ($request->age as $ageRange) {
                switch ($ageRange) {
                    case '<2':
                        $q->orWhere('age', '<', 2);
                        break;
                    case '2-4':
                        $q->orWhereBetween('age', [2, 4]);
                        break;
                    case '5-10':
                        $q->orWhereBetween('age', [5, 10]);
                        break;
                    case '11-15':
                        $q->orWhereBetween('age', [11, 15]);
                        break;
                    case '>15':
                        $q->orWhere('age', '>', 15);
                        break;
                }
            }
        });
    }

    // Get filtered pets
    $pets = $query->get();

    // Pass adopted data to the view
    return view('pets.index', compact('pets', 'adoptedPetIds', 'userAdoptedPetIds'));
}



/*
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
            'gender' => 'required|string',
            'age' => 'required|numeric|min:0',
            'medical_history' => 'nullable|string',
            'image' => 'nullable|string',
            'category' => 'required|string',
            'breed' => 'required|string',
        ]);

        return Pet::create($validated);
    }
*/
    public function show($id)
    { 
       return Pet::with('appointments')->findOrFail($id);
    }

  /*  public function update(Request $request, $id)
    {
        $pet = Pet::findOrFail($id);

        $validated = $request->validate([
            'name' => 'sometimes|string',
            'gender' => 'sometimes|string',
            'age' => 'sometimes|numeric|min:0',
            'medical_history' => 'nullable|string',
            'image' => 'nullable|string',
            'category' => 'sometimes|string',
            'breed' => 'sometimes|string',
        ]);

        $pet->update($validated);

        return $pet;
    }

    public function destroy($id)
    {
        $pet = Pet::findOrFail($id);
        $pet->delete();

        return response()->json(['message' => 'Pet deleted']);
    }
        */
}
    
