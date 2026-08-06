<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreHouseResidentRequest;
use App\Http\Requests\UpdateHouseResidentRequest;
use App\Http\Resources\HouseResidentResource;
use App\Models\HouseResident;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houseResidents = HouseResident::with('house', 'resident')->latest()->paginate(10);

        return HouseResidentResource::collection($houseResidents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseResidentRequest $request)
    {
        // Check if the house already has an active resident
        $activeResident = HouseResident::where('house_id', $request->house_id)
            ->where('is_active', true)
            ->exists();

        if ($activeResident) {
            return response()->json([
                'message' => 'House already has an active resident.'
            ], 422);
        }

        $houseResident = HouseResident::create(
            $request->validated()
        );

        return new HouseResidentResource($houseResident);
    }

    /**
     * Display the specified resource.
     */
    public function show(HouseResident $houseResident)
    {
        return new HouseResidentResource($houseResident);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHouseResidentRequest $request, HouseResident $houseResident)
    {
        $houseResident->update($request->validated());

        return new HouseResidentResource($houseResident);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HouseResident $houseResident)
    {
        $houseResident->delete();

        return response()->noContent();
    }
}
