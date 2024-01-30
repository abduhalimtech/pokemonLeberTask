<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\PokemonController;
use App\Http\Controllers\Api\AbilityController;
use App\Http\Controllers\Api\LocationController;
use App\Http\Controllers\Api\RegionController;



Route::apiResource('pokemons', PokemonController::class);
Route::apiResource('abilities', AbilityController::class);
Route::apiResource('locations', LocationController::class);
Route::apiResource('regions', RegionController::class);
Route::get('pokemons/{pokemon}/image', [PokemonController::class, 'getImage'])->name('pokemons.image');
Route::get('pokemons/filter', [PokemonController::class, 'filter'])->name('pokemons.filter');
Route::get('regions/{region}/locations', [LocationController::class, 'indexByRegion']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


