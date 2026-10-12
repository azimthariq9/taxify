<?php

namespace App\Http\Controllers\Api;

use App\Models\SptDilaporkan;

class SptDilaporkanController extends ApiController
{
    protected string $model = SptDilaporkan::class;

    protected array $rules = [
        'id_spt' => 'required|integer',
        'masa_pajak' => 'nullable|string|max:50',
        'npwp' => 'nullable|string|max:25',
        'nama' => 'nullable|string|max:100',
        'pajak_penghasilan' => 'nullable|numeric|min:0',
        'tanggal_lapor' => 'nullable|date',
        'user_id' => 'required|integer|exists:users,id',
        'akun_id' => 'nullable|integer',
        'pph21' => 'nullable|numeric|min:0',
        'pph26' => 'nullable|numeric|min:0',
    ];

    protected array $searchable = ['npwp', 'nama', 'masa_pajak'];

    protected array $filterable = ['user_id', 'akun_id', 'id_spt'];
}
