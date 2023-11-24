<?php

namespace App\Http\Requests;

use App\Rules\NotEqual;
use Illuminate\Foundation\Http\FormRequest;

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
            // 'barang_id' > 'exists:barangs,id',
            'nama' => 'required|max:255',
            'deskripsi' => 'nullable',
            'jumlah' => ['required', new NotEqual(0)],
            'harga_satuan' => 'required|gte:1',
            'penerima' => 'required|gte:1',
        ];
    }
}
