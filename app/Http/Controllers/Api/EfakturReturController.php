<?php

namespace App\Http\Controllers\Api;

use App\Models\EfakturRetur;

class EfakturReturController extends ApiController
{
    protected string $model = EfakturRetur::class;

    protected array $rules = [
        'dokumen_id' => 'required|integer|exists:efaktur_dokumen,id',
        'alasan' => 'nullable|string|max:255',
        'tanggal_retur' => 'required|date',
        'status' => 'nullable|in:diajukan,dibatalkan',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['alasan'];

    protected array $filterable = ['dokumen_id', 'user_id', 'status'];
}
