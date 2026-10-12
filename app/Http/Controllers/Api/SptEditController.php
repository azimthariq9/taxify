<?php

namespace App\Http\Controllers\Api;

use App\Models\SptEdit;

class SptEditController extends ApiController
{
    protected string $model = SptEdit::class;

    protected array $rules = [
        'id_spt_asli' => 'required|integer',
        'sumber_data' => 'nullable|string|max:50',
        'masa_pajak' => 'required|string|max:50',
        'nomor_pemotongan' => 'sometimes|string|max:50',
        'status' => 'required|string|max:50',
        'jenis_pajak' => 'required|string|max:50',
        'jenis_spt' => 'nullable|in:Normal,Pembetulan',
        'kode_pajak' => 'required|string|max:50',
        'npwp' => 'nullable|string|max:32',
        'nama' => 'nullable|string',
        'alamat' => 'nullable|string',
        'dasar_pengenaan_pajak' => 'required|numeric|min:0',
        'pajak_penghasilan' => 'required|numeric|min:0',
        'fasilitas_pajak' => 'nullable|string|max:100',
        'created_by' => 'required|string|max:100',
        'pemotong_nama' => 'nullable|string',
        'pemotong_alamat' => 'nullable|string',
        'id_spt_konsep' => 'required|integer',
        'akun_id' => 'nullable|integer',
        'user_id' => 'nullable|integer|exists:users,id',
        'pph21' => 'nullable|numeric|min:0',
        'pph26' => 'nullable|numeric|min:0',
    ];

    protected array $searchable = ['masa_pajak', 'nomor_pemotongan', 'npwp', 'nama', 'created_by'];

    protected array $filterable = ['user_id', 'akun_id', 'status', 'jenis_pajak', 'jenis_spt'];
}
