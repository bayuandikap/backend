<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseResidentRequest;
use App\Http\Requests\UpdateHouseResidentRequest;
use App\Http\Resources\HouseResidentResource;
use App\Models\House;
use App\Models\HouseResident;
use Illuminate\Support\Facades\DB;

class HouseResidentController extends Controller
{
    public function index()
    {
        $houseResidents = HouseResident::with([
            'house',
            'resident',
        ])
            ->latest()
            ->paginate(10);

        return HouseResidentResource::collection($houseResidents);
    }

    public function store(StoreHouseResidentRequest $request)
    {
        $data = $request->validated();

        $exists = HouseResident::where('resident_id', $data['resident_id'])
            ->where('is_active', true)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Resident already belongs to another house.'
            ], 422);
        }

        $house = House::findOrFail($data['house_id']);

        if ($house->status === 'occupied') {
            return response()->json([
                'message' => 'House is already occupied.'
            ], 422);
        }

        $houseResident = HouseResident::create($data);

        $house->update([
            'status' => 'occupied',
        ]);

        $houseResident->load([
            'house',
            'resident',
        ]);

        return new HouseResidentResource($houseResident);
    }

    public function show(HouseResident $houseResident)
    {
        $houseResident->load([
            'house',
            'resident',
        ]);

        return new HouseResidentResource($houseResident);
    }

    public function update(
        UpdateHouseResidentRequest $request,
        HouseResident $houseResident
    ) {
        $data = $request->validated();

        /*
         * For now, prevent changing the house/resident
         * through a normal update.
         *
         * Moving a resident should be handled as:
         * move out → assign to another house.
         */
        if (
            isset($data['house_id']) &&
            $data['house_id'] != $houseResident->house_id
        ) {
            return response()->json([
                'message' => 'To move a resident, move them out first and then assign them to another house.',
            ], 422);
        }

        if (
            isset($data['resident_id']) &&
            $data['resident_id'] != $houseResident->resident_id
        ) {
            return response()->json([
                'message' => 'Changing the resident is not allowed. Create a new house assignment instead.',
            ], 422);
        }

        $houseResident->update($data);

        $houseResident->load([
            'house',
            'resident',
        ]);

        return new HouseResidentResource($houseResident);
    }

    public function destroy(HouseResident $houseResident)
    {
        if (!$houseResident->is_active) {
            return response()->json([
                'message' => 'Resident is already inactive.'
            ], 422);
        }

        public function update(
    UpdateHouseResidentRequest $request,
    HouseResident $houseResident
) {
    $data = $request->validated();

    $oldHouseId = $houseResident->house_id;
    $newHouseId = $data['house_id'];

    /*
     * If assigning this resident to a different house
     * while keeping the relationship active,
     * make sure the target house is available.
     */
    if (
        $data['is_active'] ?? $houseResident->is_active
    ) {
        $exists = HouseResident::where('resident_id', $data['resident_id'])
            ->where('is_active', true)
            ->where('id', '!=', $houseResident->id)
            ->exists();

        if ($exists) {
            return response()->json([
                'message' => 'Resident already belongs to another house.'
            ], 422);
        }

        if ($newHouseId !== $oldHouseId) {
            $newHouse = House::findOrFail($newHouseId);

            if ($newHouse->status === 'occupied') {
                return response()->json([
                    'message' => 'House is already occupied.'
                ], 422);
            }
        }
    }

    $houseResident->update($data);

    /*
     * Synchronize old house status.
     */
    if ($oldHouseId !== $newHouseId) {
        $oldHouse = $houseResident->house;

        if ($oldHouse) {
            $hasActiveResident = HouseResident::where('house_id', $oldHouseId)
                ->where('is_active', true)
                ->exists();

            if (!$hasActiveResident) {
                $oldHouse->update([
                    'status' => 'vacant',
                ]);
            }
        }
    }

    /*
     * Synchronize new house status.
     */
    if (
        ($data['is_active'] ?? $houseResident->is_active)
    ) {
        $newHouse = House::findOrFail($newHouseId);

        $newHouse->update([
            'status' => 'occupied',
        ]);
    }

    $houseResident->load([
        'house',
        'resident',
    ]);

    return new HouseResidentResource($houseResident);
}

        return response()->json([
            'message' => 'Resident moved out.'
        ]);
    }
}
