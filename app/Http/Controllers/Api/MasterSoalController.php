<?php

namespace App\Http\Controllers\Api;

use App\Models\MasterSoal;

class MasterSoalController extends ApiController
{
    protected string $model = MasterSoal::class;

    protected array $rules = [
        'nama_soal' => 'required|string',
        'deskripsi' => 'nullable|string',
        'created_by' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['nama_soal', 'deskripsi'];

    protected array $filterable = ['created_by'];
}
