<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EventRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'titre' => 'required|min:2',
            'description' => 'required|min:10',
            'date_debut' => 'required|date',
            'date_fin' => 'required|after_or_equal:date_debut',
            'lieu' => 'required|string',
            'image' => 'required|image',
            'user_id' => 'required|exists:users,id'
        ];
    }
}
