<?php

namespace App\Http\Controllers;

use App\Models\Adoption;
use Illuminate\Http\Request;

class AdoptionController extends Controller
{
    public function index()
    {
        return Adoption::with(['user', 'pet'])->get();
    }

   public function store(Request $request)
{
    $request->validate([
        'pet_id' => 'required|exists:pets,id',
        'date' => 'required|date',
    ]);

       $userId = auth()->id() ?? 1; // Make sure user is authenticated

    if (!$userId) {
        return response()->json(['error' => 'Unauthorized'], 401);
    }

    // Prevent duplicate adoption
    $alreadyAdopted = Adoption::where('user_id', $userId)
                              ->where('pet_id', $request->pet_id)
                              ->exists();

    if ($alreadyAdopted) {
        return response()->json(['error' => 'Already adopted'], 409);
    }

    $adoption = Adoption::create([
        'user_id' => $userId,
        'pet_id' => $request->pet_id,
        'date' => $request->date,
    ]);

    return response()->json([
        'message' => 'Adoption successful',
        'adoption' => $adoption,
    ]);
}


    public function show($id)
    {
        return Adoption::with(['user', 'pet'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $adoption = Adoption::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'pet_id' => 'sometimes|exists:pets,id',
            'date' => 'sometimes|date',
        ]);

        $adoption->update($validated);

        return $adoption;
    }

    public function destroy($id)
    {
        $adoption = Adoption::findOrFail($id);
        $adoption->delete();

        return response()->json(['message' => 'Adoption deleted']);
    }
}
