<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RequestStockOutProduct extends FormRequest
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
            'tanggal_keluar' => 'required|date',
            'jumlah_keluar' => 'required|numeric',
            'media_penjualan' => 'required|string',
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
            'tanggal_keluar.required' => 'Tanggal keluar harus diisi',
            'tanggal_keluar.date' => 'Tanggal keluar harus berupa tanggal',
            'jumlah_keluar.required' => 'Jumlah keluar harus diisi',
            'jumlah_keluar.numeric' => 'Jumlah keluar harus berupa angka',
            'status.required' => 'Status harus diisi',
            'status.string' => 'Status harus berupa string',
            'media_penjualan.required' => 'Media penjualan harus diisi',
        ];
    }
}
