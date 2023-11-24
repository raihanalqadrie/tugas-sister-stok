<?php

namespace App\Http\Requests;

use App\Rules\NotEqual;
use Illuminate\Foundation\Http\FormRequest;

class AddBarangTransferRequest extends FormRequest
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
            'barang_id' > 'exists:barangs,id',
            'nama' => 'required|max:255',
            'jumlah' => [new NotEqual(0)],
            'deskripsi' => 'nullable'
        ];
    }
}