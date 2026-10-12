<?php

namespace App\Http\Controllers\Api;

use App\Models\SptMenunggu;

class SptMenungguController extends ApiController
{
    protected string $model = SptMenunggu::class;

    protected array $rules = [
        'id_konsep' => 'required|integer',
        'jenis_pajak' => 'nullable|string',
        'periode_bulan' => 'nullable|integer',
        'periode_tahun' => 'nullable|integer',
        'jenis_spt' => 'nullable|string|max:50',
        'model_spt' => 'nullable|string|max:50',
        'masa_pajak' => 'nullable|string|max:50',
        'npwp' => 'nullable|string|max:50',
        'nama' => 'nullable|string',
        'pajak_penghasilan' => 'nullable|numeric|min:0',
        'tanggal_dibuat' => 'nullable|date',
        'status' => 'nullable|string|max:50',
        'user_id' => 'required|integer|exists:users,id',
        'akun_id' => 'nullable|integer',
    ];

    protected array $searchable = ['npwp', 'nama', 'masa_pajak', 'jenis_pajak'];

    protected array $filterable = ['user_id', 'akun_id', 'status', 'id_konsep'];
}
