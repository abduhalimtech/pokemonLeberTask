<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Location;
use App\Models\Region;
use Illuminate\Http\Request;

class RegionController extends Controller
{
    public function index()
    {
        $regions = Region::all();
        return response()->json($regions);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string',
        ]);

        $region = Region::create($validated);

        return response()->json($region, 201);
    }

    public function show(Region $region)
    {
        return response()->json($region);
    }

    public function update(Request $request, Region $region)
    {
        $validated = $request->validate([
            'name' => 'string',
        ]);

        $region->update($validated);

        return response()->json($region);
    }

    public function destroy(Region $region)
    {
        $region->delete();

        return response()->noContent();
    }
}
