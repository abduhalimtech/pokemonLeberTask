<?php

namespace App\Http\Controllers\Api;

use App\Models\Pokemon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\PokemonResource;
use App\Http\Requests\PokemonStoreRequest;
use App\Http\Requests\PokemonUpdateRequest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;


class PokemonController extends Controller
{
    public function index()
    {
        $pokemons = Pokemon::all();
        return PokemonResource::collection($pokemons);
    }
    public function getImage(Pokemon $pokemon)
    {
        if (!$pokemon->image || !Storage::disk('public')->exists($pokemon->image)) {
            abort(404);
        }

        $path = $pokemon->image;
        $fileContents = Storage::disk('public')->get($path);

        $mimeType = Storage::disk('public')->mimeType($path);
        $response = new Response($fileContents, 200, ['Content-Type' => $mimeType]);

        return $response;
    }

    public function filter(Request $request)
    {
        $query = Pokemon::query();

        // Filter by location if a location_id is provided
        if ($request->has('location_id')) {
            $query->where('location_id', $request->location_id);
        }

        // Sort by name or any other attribute, defaulting to 'sequence_number'
        $sortBy = $request->get('sort_by', 'sequence_number');
        $sortOrder = $request->get('sort_order', 'asc'); // or 'desc'

        $pokemons = $query->orderBy($sortBy, $sortOrder)->get();

        return PokemonResource::collection($pokemons);
    }


    public function store(PokemonStoreRequest $request)
    {
        $data = $request->validated();
        $data['image'] = $request->file('image')->store('pokemon_images', 'public');

        $pokemon = Pokemon::create($data);
        $pokemon->abilities()->sync($request->input('abilities', []));

        return new PokemonResource($pokemon);
    }

    public function show(Pokemon $pokemon)
    {
        return new PokemonResource($pokemon);
    }

    public function update(PokemonUpdateRequest $request, Pokemon $pokemon)
    {
        $data = $request->validated();

        if ($request->hasFile('image')) {
            Storage::delete('public/' . $pokemon->image);
            $data['image'] = $request->file('image')->store('pokemon_images', 'public');
        }

        $pokemon->update($data);
        $pokemon->abilities()->sync($request->input('abilities', []));

        return new PokemonResource($pokemon);
    }

    public function destroy(Pokemon $pokemon)
    {
        Storage::delete('public/' . $pokemon->image);
        $pokemon->delete();

        return response()->noContent();
    }
}
