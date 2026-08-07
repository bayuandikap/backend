<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Http\Resources\ResidentResource;
use App\Models\Resident;
use Illuminate\Http\Request;

class ResidentController extends Controller
{
    public function index(Request $request)
    {
        $query = Resident::query();

        $query->when($request->search, function ($q, $search) {
            $q->where('name', 'like', "%{$search}%");
        });

        $query->when($request->gender, function ($q, $gender) {
            $q->where('gender', $gender);
        });

        $residents = Resident::latest()->paginate(10);

        return ResidentResource::collection($residents);
    }

    public function store(StoreResidentRequest $request)
    {
        $resident = Resident::create($request->validated());

        return new ResidentResource($resident);
    }

    public function show(Resident $resident)
    {
        return new ResidentResource($resident);
    }

    public function update(UpdateResidentRequest $request, Resident $resident)
    {
        $resident->update($request->validated());

        return new ResidentResource($resident);
    }

    public function destroy(Resident $resident)
    {
        $resident->delete();

        return response()->json([
            'message' => 'Resident deleted successfully.'
        ]);
    }
}
