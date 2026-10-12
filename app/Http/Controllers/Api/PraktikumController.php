<?php

namespace App\Http\Controllers\Api;

use App\Models\Praktikum;

class PraktikumController extends ApiController
{
    protected string $model = Praktikum::class;

    protected array $rules = [
        'id_kelas' => 'required|integer|exists:kelas,id_kelas',
        'nama_praktikum' => 'required|string|max:200',
        'deskripsi' => 'nullable|string',
        'tanggal_mulai' => 'nullable|date',
        'tanggal_selesai' => 'nullable|date',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['nama_praktikum', 'deskripsi'];

    protected array $filterable = ['id_kelas', 'user_id'];
}
