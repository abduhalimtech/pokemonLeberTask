<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PokemonUpdateRequest extends FormRequest
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
        return [
            'name' => 'sometimes|string|unique:pokemon,name,' . $this->pokemon->id,
            'image' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'sequence_number' => 'sometimes|string|unique:pokemon,sequence_number,' . $this->pokemon->id,
            'form' => 'sometimes|in:head,head_legs,fins,wings',
            'location_id' => 'sometimes|exists:locations,id',
            'abilities' => 'sometimes|array',
            'abilities.*' => 'exists:abilities,id'
        ];
    }
}
