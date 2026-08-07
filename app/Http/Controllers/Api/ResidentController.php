<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreResidentRequest;
use App\Http\Requests\UpdateResidentRequest;
use App\Http\Resources\ResidentResource;
use App\Models\Resident;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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

        $query->when($request->resident_status, function ($q, $status) {
            $q->where('resident_status', $status);
        });

        $residents = Resident::latest()->paginate(10);

        return ResidentResource::collection($residents);
    }

    public function store(StoreResidentRequest $request)
    {
        $data = $request->validated();

        if ($request->hasFile('ktp_photo')) {
            $data['ktp_photo'] = $request
                ->file('ktp_photo')
                ->store('ktp', 'public');
        }

        $resident = Resident::create($data);

        return new ResidentResource($resident);
    }

    public function show(Resident $resident)
    {
        return new ResidentResource($resident);
    }

    public function update(UpdateResidentRequest $request, Resident $resident)
    {
        $data = $request->validated();

        if ($request->hasFile('ktp_photo')) {

            if ($resident->ktp_photo) {
                Storage::disk('public')->delete($resident->ktp_photo);
            }

            $data['ktp_photo'] = $request
                ->file('ktp_photo')
                ->store('ktp', 'public');
        }

        $resident->update($data);

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
