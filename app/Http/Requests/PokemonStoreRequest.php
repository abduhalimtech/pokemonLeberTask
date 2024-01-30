<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // return [
        //     'name' => 'required|string|unique:pokemon,name,' . $this->pokemon,
        //     'image' => 'nullable|file|mimes:jpeg,png,jpg',
        //     'sorting_index' => 'required|integer',
        //     'form' => 'required|in:head,head_legs,fins,wings',
        //     'location' => 'nullable|string',
        //     'abilities' => 'nullable|array',
        //     'abilities.*.name_en' => 'required_with:abilities|string',
        //     'abilities.*.name_ru' => 'required_with:abilities|string',
        //     'abilities.*.image' => 'nullable|file|mimes:jpeg,png,jpg',
        // ];
        return [
            'name' => 'required|string|unique:pokemon,name',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sequence_number' => 'required|string|unique:pokemon,sequence_number',
            'form' => 'required|in:head,head_legs,fins,wings',
            'location_id' => 'required|exists:locations,id',
            'abilities' => 'required|array',
            'abilities.*' => 'exists:abilities,id'
        ];
    }
}
