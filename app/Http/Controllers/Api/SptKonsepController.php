<?php

namespace App\Http\Controllers\Api;

use App\Models\SptKonsep;

class SptKonsepController extends ApiController
{
    protected string $model = SptKonsep::class;

    protected array $rules = [
        'jenis_pajak' => 'required|string|max:100',
        'periode_bulan' => 'required|string|max:20',
        'periode_tahun' => 'required|string|max:10',
        'jenis_spt' => 'required|string|max:100',
        'sumber_data_json' => 'nullable|array',
        'sumber_id' => 'nullable|integer',
        'model_spt' => 'nullable|string|max:50',
        'nop' => 'nullable|string|max:50',
        'nama_objek' => 'nullable|string|max:50',
        'status' => 'nullable|string|max:50',
        'masa_pajak' => 'nullable|string|max:30',
        'created_by' => 'nullable|string|max:255',
        'pemotong_alamat' => 'nullable|string',
        'npwp' => 'nullable|string|max:50',
        'nama' => 'nullable|string',
        'user_id' => 'required|integer|exists:users,id',
        'posted_at' => 'nullable|date',
        'akun_id' => 'nullable|integer',
    ];

    protected array $searchable = ['jenis_pajak', 'npwp', 'nama', 'masa_pajak', 'status'];

    protected array $filterable = ['user_id', 'akun_id', 'status', 'jenis_pajak'];
}
