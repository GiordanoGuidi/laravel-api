<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;


class StoreProjectRequest extends FormRequest
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
        $id = $this->route('project');
        return [
            'title' => 'required|string|unique:projects',
            'content' => 'nullable|string',
            'image' => 'required|image|mimes:png,jpg,jpeg',
            'type_id' => 'nullable|exists:types,id',
            'technologies' => 'nullable|exists:technologies,id'
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il campo title è obbligatorio',
            'title.string' => 'Il campo title deve essere una parola',
            'title.unique' => 'Questo titolo è gia esistente',
            'content.string' => 'Il campo content deve essere una parola',
            'image.required' => 'Il campo image è obbligatorio',
            'image.image' => 'Il file caricato deve essere un immagine',
            'image.mimes' => 'L\'immagine deve essere di formato PNG, JPG o JPEG',
            'type_id' => 'Categoria non valida o non esistente',
            'technologies.exists' => 'Tecnologia non valida',
        ];
    }
}
