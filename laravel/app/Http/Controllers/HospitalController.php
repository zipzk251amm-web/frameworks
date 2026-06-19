<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Hospital;
use Symfony\Component\HttpFoundation\Response;

class HospitalController extends Controller
{
    public function getHospitals()
    {
        $hospitals = Hospital::all();
        return response()->json(['data' => $hospitals], Response::HTTP_OK);
    }

    public function getHospitalItem($id)
    {
        $hospital = Hospital::find($id);
        if (!$hospital) {
            return response()->json(['error' => 'Hospital not found'], Response::HTTP_NOT_FOUND);
        }
        return response()->json(['data' => $hospital], Response::HTTP_OK);
    }

    public function createHospital(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'beds' => 'required|integer|min:1',
            'rating' => 'nullable|numeric|min:0|max:5',
        ]);

        $hospital = Hospital::create($validatedData);
        return response()->json(['data' => $hospital], Response::HTTP_CREATED);
    }

    public function patchHospital(Request $request, $id)
    {
        $hospital = Hospital::find($id);
        if (!$hospital) {
            return response()->json(['error' => 'Hospital not found'], Response::HTTP_NOT_FOUND);
        }

        $validatedData = $request->validate([
            'name' => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'phone' => 'sometimes|string|max:20',
            'beds' => 'sometimes|integer|min:1',
            'rating' => 'sometimes|numeric|min:0|max:5',
        ]);

        $hospital->update($validatedData);
        return response()->json(['data' => $hospital], Response::HTTP_OK);
    }

    public function deleteHospital($id)
    {
        $hospital = Hospital::find($id);
        if (!$hospital) {
            return response()->json(['error' => 'Hospital not found'], Response::HTTP_NOT_FOUND);
        }
        $hospital->delete();
        return response()->json(null, Response::HTTP_NO_CONTENT);
    }
}