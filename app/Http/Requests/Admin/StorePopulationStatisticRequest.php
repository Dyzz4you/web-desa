<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class StorePopulationStatisticRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'year' => ['required', 'digits:4', 'integer', 'min:2000', 'unique:population_statistics,year'],
            'total_population' => ['required', 'integer', 'min:0'],
            'male_count' => ['required', 'integer', 'min:0'],
            'female_count' => ['required', 'integer', 'min:0'],
            'family_count' => ['required', 'integer', 'min:0'],
            'birth_count' => ['nullable', 'integer', 'min:0'],
            'death_count' => ['nullable', 'integer', 'min:0'],
            'moved_in_count' => ['nullable', 'integer', 'min:0'],
            'moved_out_count' => ['nullable', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'is_active' => ['required', 'boolean'],
        ];
    }
}