<?php

namespace App\Http\Controllers\Api;

use App\Models\KelasPraktikumFile;

class KelasPraktikumFileController extends ApiController
{
    protected string $model = KelasPraktikumFile::class;

    protected array $rules = [
        'id_praktikum' => 'required|integer|exists:kelas_praktikum,id',
        'nama_file' => 'nullable|string|max:255',
        'path_file' => 'nullable|string|max:255',
        'uploaded_at' => 'nullable|date',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['nama_file', 'path_file'];

    protected array $filterable = ['id_praktikum', 'user_id'];
}
