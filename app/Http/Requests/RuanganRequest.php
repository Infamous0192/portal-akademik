<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RuanganRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'nama' => 'required',
            'kode' => [
                'required',
                Rule::unique(\App\Models\Ruangan::class, 'kode')->ignore($this->route('ruangan'), 'id')
            ],
            'id_gedung' => [
                'required',
                Rule::exists(\App\Models\Gedung::class, 'id')
            ]
        ];
    }
}
