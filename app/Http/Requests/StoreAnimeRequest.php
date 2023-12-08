<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAnimeRequest extends FormRequest
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
        'title' => ['required', 'string'],
        'episodes'=> ['required', 'integer'],
        'release_date' => ['required', 'date'],
        'studio_id' => ['required', 'integer'],
        'genre_ids' => ['required', 'array', 'min:1'],
        'genre_ids.*' => ['required', 'integer'],
        ];
    }
}
