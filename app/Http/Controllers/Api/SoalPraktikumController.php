<?php

namespace App\Http\Controllers\Api;

use App\Models\SoalPraktikum;

class SoalPraktikumController extends ApiController
{
    protected string $model = SoalPraktikum::class;

    protected array $rules = [
        'praktikum_id' => 'required|integer|exists:praktikum,id_praktikum',
        'soal' => 'required|string|max:100',
        'file_support' => 'nullable|string|max:255',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['soal'];

    protected array $filterable = ['praktikum_id', 'user_id'];
}
