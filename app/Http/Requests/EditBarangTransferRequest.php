<?php

namespace App\Http\Requests;

use App\Rules\NotEqual;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class EditBarangTransferRequest extends FormRequest
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
            'deskripsi' => 'nullable',
            'tipe' => ['required', Rule::in(['masuk', 'keluar'])],
            'jumlah' => 'required|numeric',
            'harga_satuan' => 'required|numeric|gte:1',
            'penerima' => 'required',
        ];
    }
}
