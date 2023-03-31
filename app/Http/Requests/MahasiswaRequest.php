<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class MahasiswaRequest extends FormRequest
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
            'nim' => [
                'required',
                Rule::unique(\App\Models\Mahasiswa::class, 'nim')->ignore($this->route('mahasiswa'), 'id')
            ],
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'no_telepon' => 'required',
            'foto' => [
                Rule::requiredIf($this->method() == 'POST'),
                File::image(),
            ],
            'id_prodi' => [
                'required',
                Rule::exists(\App\Models\Prodi::class, 'id')
            ],
        ];
    }
}
