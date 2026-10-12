<?php

namespace App\Http\Controllers\Api;

use App\Models\KodeBilling;

class KodeBillingController extends ApiController
{
    protected string $model = KodeBilling::class;

    protected array $rules = [
        'id_spt' => 'required|integer|exists:spt_edit,id',
        'jenis_spt' => 'nullable|string|max:50',
        'kode' => 'required|string|max:50',
        'masa_pajak' => 'nullable|string|max:20',
        'tahun_pajak' => 'nullable|integer',
        'jenis_setoran' => 'nullable|string|max:20',
        'jumlah' => 'nullable|numeric|min:0',
        'tanggal_buat' => 'nullable|date',
        'status' => 'nullable|in:AKTIF,KEDALUWARSA',
        'user_id' => 'nullable|integer|exists:users,id',
    ];

    protected array $searchable = ['kode', 'masa_pajak', 'jenis_spt'];

    protected array $filterable = ['id_spt', 'user_id', 'status', 'tahun_pajak'];
}
