<?php

namespace App\Http\Controllers\Api;

use App\Models\SptWpln;

class SptWplnController extends ApiController
{
    protected string $model = SptWpln::class;

    protected array $rules = [
        'masa_pajak' => 'required|string|max:20',
        'nomor_pemotongan' => 'required|string|max:50',
        'status' => 'required|string|max:50',
        'nitku' => 'nullable|string|max:50',
        'jenis_pajak' => 'required|string|max:50',
        'kode_pajak' => 'required|string|max:10',
        'npwp' => 'required|string|max:20',
        'nama' => 'required|string|max:200',
        'alamat' => 'required|string',
        'dasar_pengenaan_pajak' => 'nullable|integer|min:0',
        'pajak_penghasilan' => 'nullable|integer|min:0',
        'fasilitas_pajak' => 'nullable|string|max:100',
        'user_id' => 'required|integer|exists:users,id',
        'created_by' => 'nullable|string',
        'pemotong_nama' => 'nullable|string',
        'pemotong_alamat' => 'nullable|string',
        'akun_id' => 'nullable|integer',
    ];

    protected array $searchable = ['npwp', 'nama', 'nomor_pemotongan', 'masa_pajak'];

    protected array $filterable = ['user_id', 'akun_id', 'status', 'masa_pajak'];
}
