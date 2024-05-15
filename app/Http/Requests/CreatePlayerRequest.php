<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreatePlayerRequest extends FormRequest
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
                'name' => 'required|string|max:20',
                'team_id' => 'nullable|integer',
                'position' => 'required|string|max:50',
                'age' => 'required|integer|max:65',
                'nationality' => 'required|string|max:50',
                'number_of_goals_this_season' => 'required|integer',
                'user_id' => 'nullable|integer'
        ];
    }
}
