<?php

namespace App\Http\Controllers\Api;

use App\Models\Kelas;

class KelasController extends ApiController
{
    protected string $model = Kelas::class;

    protected array $rules = [
        'kode_kelas' => 'required|string|max:50',
        'status' => 'nullable|in:aktif,nonaktif',
        'nama_kelas' => 'required|string|max:150',
        'tanggal_mulai' => 'nullable|date',
        'tanggal_selesai' => 'nullable|date',
        'file_pdf' => 'nullable|string|max:255',
        'created_by' => 'nullable|integer|exists:users,id',
    ];

    protected array $searchable = ['kode_kelas', 'nama_kelas'];

    protected array $filterable = ['status', 'created_by'];
}
