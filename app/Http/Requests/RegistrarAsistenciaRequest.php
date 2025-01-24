<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrarAsistenciaRequest extends FormRequest
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
            'dni' => 'required|numeric|digits:8',
            'action' => 'required|in:entrada,salida',
        ];
    }

    public function messages()
    {
        return [
            'dni.required' => 'El campo DNI es obligatorio.',
            'dni.numeric' => 'El campo DNI debe ser un número.',
            'dni.digits' => 'El campo DNI debe tener 8 dígitos.',
            'action.required' => 'La acción es obligatoria.',
            'action.in' => 'La acción debe ser entrada o salida.',
        ];
    }
}
