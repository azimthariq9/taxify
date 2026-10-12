<?php

namespace App\Http\Controllers\Api;

use App\Models\SptA1;

class SptA1Controller extends ApiController
{
    protected string $model = SptA1::class;

    protected array $rules = [
        'status' => 'nullable|in:Belum Terbit,Terbit,Tidak Valid',
        'masa_pajak' => 'nullable|string|max:20',
        'periode_bulan_awal' => 'nullable|string|max:20',
        'periode_tahun_awal' => 'nullable|string|max:10',
        'periode_bulan_akhir' => 'nullable|string|max:20',
        'periode_tahun_akhir' => 'nullable|string|max:10',
        'nomor_bukti_potong' => 'nullable|string|max:100',
        'tanggal_bukti_potong' => 'nullable|date',
        'kode_objek_pajak' => 'nullable|string|max:30',
        'fasilitas_pajak' => 'nullable|string|max:100',
        'npwp' => 'nullable|string|max:20',
        'nama' => 'nullable|string|max:200',
        'alamat' => 'nullable|string',
        'penghasilan_bruto' => 'nullable|integer|min:0',
        'pajak_penghasilan' => 'nullable|integer|min:0',
        'user_id' => 'required|integer|exists:users,id',
        'akun_id' => 'nullable|integer',
    ];

    protected array $searchable = ['npwp', 'nama', 'nomor_bukti_potong', 'masa_pajak'];

    protected array $filterable = ['user_id', 'akun_id', 'status', 'masa_pajak'];
}
