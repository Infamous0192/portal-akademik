<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class DosenRequest extends FormRequest
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
            'nip' => [
                'required',
                Rule::unique(\App\Models\Dosen::class, 'nip')->ignore($this->route('dosen'), 'id')
            ],
            'tempat_lahir' => 'required',
            'tanggal_lahir' => 'required|date',
            'jenis_kelamin' => 'required',
            'alamat' => 'required',
            'agama' => 'required',
            'no_telepon' => 'required',
            'foto' => [
                'required',
                File::image(),
            ],
            'id_prodi' => [
                'required',
                Rule::exists(\App\Models\Prodi::class, 'id')
            ],
            'id_fakultas' => [
                'required',
                Rule::exists(\App\Models\Fakultas::class, 'id')
            ],
        ];
    }
}
