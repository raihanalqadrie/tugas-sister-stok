<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditBarangRequest extends FormRequest
{
    /**
     * Determine if the barang is authorized to make this request.
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'required|max:255',
            'deskripsi' => 'nullable'
        ];
    }
}
