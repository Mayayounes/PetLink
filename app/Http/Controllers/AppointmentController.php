<?php

namespace App\Http\Controllers;

use App\Models\Appointment;
use Illuminate\Http\Request;

class AppointmentController extends Controller
{
    public function index()
    {
        return Appointment::with(['user', 'pet'])->get();
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'pet_id' => 'required|exists:pets,id',
            'date' => 'required|date',
        ]);

        return Appointment::create($validated);
    }

    public function show($id)
    {
        return Appointment::with(['user', 'pet'])->findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $appointment = Appointment::findOrFail($id);

        $validated = $request->validate([
            'user_id' => 'sometimes|exists:users,id',
            'pet_id' => 'sometimes|exists:pets,id',
            'date' => 'sometimes|date',
        ]);

        $appointment->update($validated);

        return $appointment;
    }

    public function destroy($id)
    {
        $appointment = Appointment::findOrFail($id);
        $appointment->delete();

        return response()->json(['message' => 'Appointment deleted']);
    }
}
