<?php

namespace App\Http\Controllers\Api;

use App\Models\PraktikumMandiri;

class PraktikumMandiriController extends ApiController
{
    protected string $model = PraktikumMandiri::class;

    protected array $rules = [
        'nama_praktikum' => 'required|string',
        'pembuat' => 'required|string',
        'soal' => 'required|string',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['nama_praktikum', 'pembuat', 'soal'];

    protected array $filterable = ['user_id'];
}
