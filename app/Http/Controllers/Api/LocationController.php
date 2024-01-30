<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\LocationStoreRequest;
use App\Http\Requests\LocationUpdateRequest;
use App\Models\Location;
use App\Models\Region;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index(Request $request)
    {
        $query = Location::query();

        // If a region_id is provided, filter locations by the region
        if ($request->has('region_id')) {
            $query->where('region_id', $request->region_id);
        }

        $locations = $query->get();

        return response()->json($locations);
    }

    public function indexByRegion(Region $region)
    {
        $locations = $region->locations;
        return response()->json($locations);
    }


    public function store(LocationStoreRequest $request)
    {
        $data = $request->validated();

        $location = Location::create($data);

        return response()->json($location, 201);
    }

    public function show(Location $location)
    {
        return response()->json($location);
    }

    public function update(LocationUpdateRequest $request, Location $location)
    {
        $data = $request->validated();

        $location->update($data);

        return response()->json($location);
    }

    public function destroy(Location $location)
    {
        $location->delete();

        return response()->noContent();
    }
}
