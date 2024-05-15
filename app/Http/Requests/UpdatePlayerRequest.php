<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePlayerRequest extends FormRequest
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
            'name' => 'sometimes|string|max:20',
            'team_id' => 'nullable|integer',
            'position' => 'sometimes|string|max:50',
            'age' => 'sometimes|integer|max:65',
            'nationality' => 'sometimes|string|max:50',
            'number_of_goals_this_season' => 'sometimes|integer'
        ];
    }
}
