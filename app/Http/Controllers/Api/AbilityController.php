<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\AbilityStoreRequest;
use App\Http\Requests\AbilityUpdateRequest;
use App\Http\Resources\AbilityResource;
use App\Models\Ability;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AbilityController extends Controller
{
    public function index()
    {
        $abilities = Ability::all();
        return AbilityResource::collection($abilities);
    }

    public function store(AbilityStoreRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('ability_images', 'public');

        $ability = Ability::create($data);

        return new AbilityResource($ability);
    }

    public function show(Ability $ability)
    {
        return new AbilityResource($ability);
    }

    public function update(AbilityUpdateRequest $request, Ability $ability)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($ability->image);
            $data['image'] = $request->file('image')->store('ability_images', 'public');
        }

        $ability->update($data);

        return new AbilityResource($ability);
    }

    public function destroy(Ability $ability)
    {
        Storage::disk('public')->delete($ability->image);
        $ability->delete();

        return response()->noContent();
    }
}
