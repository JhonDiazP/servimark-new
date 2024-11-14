<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'identification_type_id' => 'required|integer|exists:identification_types,id',
            'identification' => 'required|string|max:255',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender_id' => 'required|integer|exists:gender,id',
            'phone' => 'max:20|unique:users',
            'municipality_id' => 'required|integer|exists:municipalities,id',
            'email' => 'required|email|unique:users',
            'roles' => 'sometimes|required',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'document_type_id.required' => 'El tipo de documento es requerido.',
            'document_type_id.integer' => 'El tipo de documento debe ser un número entero.',
            'document_type_id.exists' => 'El tipo de documento no existe.',
            'document.required' => 'El documento es requerido.',
            'document.string' => 'El documento debe ser una cadena de texto.',
            'document.max' => 'El documento no puede tener más de 255 caracteres.',
            'document.unique' => 'El documento ya está en uso.',
            'firstname.required' => 'El nombre es requerido.',
            'firstname.string' => 'El nombre debe ser una cadena de texto.',
            'firstname.max' => 'El nombre no puede tener más de 255 caracteres.',
            'lastname.required' => 'El apellido es requerido.',
            'lastname.string' => 'El apellido debe ser una cadena de texto.',
            'lastname.max' => 'El apellido no puede tener más de 255 caracteres.',
            'phone.string' => 'El teléfono debe ser una cadena de texto.',
            'phone.max' => 'El teléfono no puede tener más de 20 caracteres.',
            'phone.unique' => 'El teléfono ya está en uso.',
            'email.required' => 'El correo electrónico es requerido.',
            'email.email' => 'El correo electrónico debe ser válido.',
            'email.unique' => 'El correo electrónico ya está en uso.'
        ];
    }
}
