<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;

class MatakuliahRequest extends FormRequest
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
                Rule::unique(\App\Models\Matakuliah::class, 'kode')->ignore($this->route('matakuliah'), 'id')
            ],
            'sks' => 'required|integer|min=0',
            'semester' => 'required|integer|min=1',
            'hari' => 'required',
            'waktu_mulai' => 'required',
            'waktu_selesai' => 'required',
            'kategori' => 'required',
            'id_prodi' => [
                'required',
                Rule::exists(\App\Models\Prodi::class, 'id')
            ],
            'id_ruangan' => [
                'required',
                Rule::exists(\App\Models\Ruangan::class, 'id')
            ],
        ];
    }
}
