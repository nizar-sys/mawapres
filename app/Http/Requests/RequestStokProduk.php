<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStokProduk extends FormRequest
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
            'produk_id' => 'required|exists:produks,id',
            'warna_id' => 'required|exists:product_colors,id',
            'stok_minimum' => 'required|numeric',
            // 'stok_awal' => 'required|numeric',
            // 'status' => 'required|in:restock,stock_ok',
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
            'produk_id.required' => 'Produk harus diisi.',
            'produk_id.exists' => 'Produk tidak ditemukan.',
            'warna_id.required' => 'Warna harus diisi.',
            'warna_id.exists' => 'Warna tidak ditemukan.',
            'stok.required' => 'Stok harus diisi.',
            'stok.numeric' => 'Stok harus berupa angka.',
            'stok_minimum.required' => 'Stok minimum harus diisi.',
            'stok_minimum.numeric' => 'Stok minimum harus berupa angka.',
            'status.required' => 'Status harus diisi.',
            'status.in' => 'Status tidak ditemukan.',
            'stok_awal.required' => 'Stok awal harus diisi.',
            'stok_awal.numeric' => 'Stok awal harus berupa angka.',
        ];
    }
}
