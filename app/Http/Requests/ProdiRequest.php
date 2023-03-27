<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProdiRequest extends FormRequest
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
                Rule::unique(\App\Models\Prodi::class, 'kode')->ignore($this->route('prodi'), 'id')
            ],
            'jenjang' => [
                'required',
                Rule::in(['D3', 'S1', 'S2', 'S3'])
            ],
            'id_fakultas' => [
                'required',
                Rule::exists(\App\Models\Fakultas::class, 'id')
            ]
        ];
    }
}
