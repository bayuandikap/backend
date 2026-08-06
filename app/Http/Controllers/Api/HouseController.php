<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;

use App\Http\Requests\StoreHouseRequest;
use App\Http\Requests\UpdateHouseRequest;
use App\Http\Resources\HouseResource;
use App\Models\House;

class HouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $houses = House::with('residents')->latest()->paginate(10);

        return HouseResource::collection($houses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreHouseRequest $request)
    {
        $house = House::create(
            $request->validated()
        );

        return new HouseResource($house);


    }

    /**
     * Display the specified resource.
     */
    public function show(House $house)
    {
        return new HouseResource($house);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateHouseRequest $request, House $house)
    {
        $house->update($request->validated());

        return new HouseResource($house);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(House $house)
    {
        $house->delete();

        return response()->noContent();
    }
}
