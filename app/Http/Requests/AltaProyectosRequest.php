<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AltaProyectosRequest extends FormRequest
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

                'Nombre_proyecto' => ['required'],
                'Cliente' => ['required', 'exists:clientes,nombre'],
                'Presupuesto' => ['required'],
                'Fecha_diseno' => ['required'],
                'Fecha_obra' => ['required'],
                'Fecha_fin' => ['required'],
                'Responsable' => ['required'],
        ];
    }
}
