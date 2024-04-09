<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class RequestStockInProduct extends FormRequest
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
            'stok_produk_id' => 'required|exists:stok_produks,id|',
            'vendor_id' => 'required|exists:vendors,id|',
            'tanggal_masuk' => 'required|date',
            'jumlah_masuk' => 'required|numeric',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array<string, mixed>
     */
    public function messages()
    {
        return [
            'stok_produk_id.required' => 'Produk harus diisi',
            'stok_produk_id.exists' => 'Produk tidak ditemukan',
            'warna_id.required' => 'Warna harus diisi',
            'warna_id.exists' => 'Warna tidak ditemukan',
            'vendor_id.required' => 'Vendor harus diisi',
            'vendor_id.exists' => 'Vendor tidak ditemukan',
            'tanggal_masuk.required' => 'Tanggal masuk harus diisi',
            'tanggal_masuk.date' => 'Tanggal masuk harus berupa tanggal',
            'jumlah_masuk.required' => 'Jumlah masuk harus diisi',
            'jumlah_masuk.numeric' => 'Jumlah masuk harus berupa angka',
            'status.required' => 'Status harus diisi',
            'status.string' => 'Status harus berupa string',
        ];
    }
}
