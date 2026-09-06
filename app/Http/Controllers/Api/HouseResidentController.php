<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseResidentRequest;
use App\Http\Requests\UpdateHouseResidentRequest;
use App\Http\Resources\HouseResidentResource;
use App\Models\HouseResident;

class HouseResidentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houseResidents = HouseResident::with([
            'house',
            'resident'
        ])
            ->latest()
            ->paginate(10);

        return HouseResidentResource::collection($houseResidents);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseResidentRequest $request)
    {
        $exists = HouseResident::where(
            'resident_id',
            $request->resident_id
        )
            ->where('is_active', true)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Resident already belongs to another house.'
            ], 422);
        }

        $houseResident = HouseResident::create(
            $request->validated()
        );

        $houseResident->load([
            'house',
            'resident'
        ]);

        return new HouseResidentResource($houseResident);
    }

    /**
     * Display the specified resource.
     */
    public function show(HouseResident $houseResident)
    {
        $houseResident->load([
            'house',
            'resident'
        ]);

        return new HouseResidentResource($houseResident);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        UpdateHouseResidentRequest $request,
        HouseResident $houseResident
    ) {
        $data = $request->validated();

        /*
         * If changing the resident or house, make sure
         * the selected resident does not already have
         * another active house assignment.
         */
        $residentChanged =
            isset($data['resident_id']) &&
            $data['resident_id'] != $houseResident->resident_id;

        if (
            $residentChanged &&
            ($data['is_active'] ?? $houseResident->is_active)
        ) {
            $exists = HouseResident::where(
                'resident_id',
                $data['resident_id']
            )
                ->where('is_active', true)
                ->where('id', '!=', $houseResident->id)
                ->exists();

            if ($exists) {
                return response()->json([
                    'message' =>
                        'Resident already belongs to another house.'
                ], 422);
            }
        }

        $houseResident->update($data);

        $houseResident->load([
            'house',
            'resident'
        ]);

        return new HouseResidentResource($houseResident);
    }

    /**
     * Move a resident out of a house.
     */
    public function destroy(HouseResident $houseResident)
    {
        if (!$houseResident->is_active) {
            return response()->json([
                'message' => 'Resident is already inactive.'
            ], 422);
        }

        $houseResident->update([
            'is_active' => false,
            'end_date' => today(),
        ]);

        return response()->json([
            'message' => 'Resident moved out.'
        ]);
    }
}
