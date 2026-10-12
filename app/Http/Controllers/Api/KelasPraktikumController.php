<?php

namespace App\Http\Controllers\Api;

use App\Models\KelasPraktikum;

class KelasPraktikumController extends ApiController
{
    protected string $model = KelasPraktikum::class;

    protected array $rules = [
        'kelas_id' => 'required|integer|exists:kelas,id_kelas',
        'nama_praktikum' => 'required|string|max:100',
        'deskripsi_file' => 'nullable|string|max:255',
        'tanggal_mulai' => 'nullable|date',
        'tanggal_selesai' => 'nullable|date',
        'created_by' => 'nullable|integer|exists:users,id',
    ];

    protected array $searchable = ['nama_praktikum', 'deskripsi_file'];

    protected array $filterable = ['kelas_id', 'created_by'];
}
