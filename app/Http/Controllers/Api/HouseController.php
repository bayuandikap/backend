<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Http\Resources\HouseResource;
use App\Models\House;
use Illuminate\Http\Request;

class HouseController extends Controller
{
    public function index(Request $request)
    {
        $query = House::query();

        if ($request->filled('status')) {
            $query->where(
                'status',
                $request->status
            );
        }

        if ($request->filled('search')) {

            $query->where(function ($q) use ($request) {

                $q->where(
                    'house_number',
                    'like',
                    "%{$request->search}%"
                )
                    ->orWhere(
                        'block',
                        'like',
                        "%{$request->search}%"
                    );
            });
        }

        $perPage = min(
            (int) $request->input('per_page', 10),
            1000
        );

        return HouseResource::collection(
            $query
                ->latest()
                ->paginate($perPage)
        );
    }

    public function store(StoreHouseRequest $request)
    {
        $house = House::create(
            $request->validated()
        );

        return new HouseResource($house);
    }

    public function show(House $house)
    {
        return new HouseResource($house);
    }

    public function update(
        UpdateHouseRequest $request,
        House $house
    ) {
        $house->update(
            $request->validated()
        );

        return new HouseResource($house);
    }

    public function destroy(House $house)
    {
        $house->delete();

        return response()->noContent();
    }
}
