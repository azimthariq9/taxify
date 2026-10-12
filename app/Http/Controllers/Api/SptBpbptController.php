<?php

namespace App\Http\Controllers\Api;

use App\Models\SptBpbpt;

class SptBpbptController extends ApiController
{
    protected string $model = SptBpbpt::class;

    protected array $rules = [
        'masa_pajak' => 'nullable|string|max:20',
        'periode_bulan' => 'nullable|string|max:20',
        'periode_tahun' => 'nullable|string|max:4',
        'nomor_pemotongan' => 'nullable|string|max:50',
        'status' => 'nullable|string|max:20',
        'nitku' => 'nullable|string|max:100',
        'jenis_pajak' => 'nullable|string|max:100',
        'kode_pajak' => 'nullable|string|max:50',
        'npwp' => 'nullable|string|max:30',
        'nama' => 'nullable|string|max:100',
        'alamat' => 'nullable|string|max:255',
        'dasar_pengenaan_pajak' => 'nullable|numeric|min:0',
        'pajak_penghasilan' => 'nullable|numeric|min:0',
        'fasilitas_pajak' => 'nullable|string|max:100',
        'created_by' => 'nullable|string',
        'pemotong_nama' => 'nullable|string',
        'pemotong_alamat' => 'nullable|string',
        'user_id' => 'required|integer|exists:users,id',
        'akun_id' => 'nullable|integer',
    ];

    protected array $searchable = ['npwp', 'nama', 'nomor_pemotongan', 'masa_pajak'];

    protected array $filterable = ['user_id', 'akun_id', 'status', 'masa_pajak'];
}
