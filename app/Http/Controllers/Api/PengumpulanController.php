<?php

namespace App\Http\Controllers\Api;

use App\Models\Pengumpulan;

class PengumpulanController extends ApiController
{
    protected string $model = Pengumpulan::class;

    protected array $rules = [
        'praktikum_id' => 'required|integer|exists:kelas_praktikum,id',
        'user_id' => 'required|integer|exists:users,id',
        'file_jawaban' => 'nullable|string|max:255',
        'catatan' => 'nullable|string',
        'uploaded_at' => 'nullable|date',
        'status' => 'nullable|in:menunggu,dinilai',
        'nilai' => 'nullable|numeric|min:0|max:100',
        'feedback' => 'nullable|string',
    ];

    protected array $searchable = ['catatan', 'feedback', 'file_jawaban'];

    protected array $filterable = ['praktikum_id', 'user_id', 'status'];
}
