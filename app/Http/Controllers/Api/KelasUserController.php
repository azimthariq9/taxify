<?php

namespace App\Http\Controllers\Api;

use App\Models\KelasUser;

class KelasUserController extends ApiController
{
    protected string $model = KelasUser::class;

    protected array $rules = [
        'user_id' => 'required|integer|exists:users,id',
        'kelas_id' => 'required|integer|exists:kelas,id_kelas',
        'joined_at' => 'nullable|date',
    ];

    protected array $searchable = [];

    protected array $filterable = ['user_id', 'kelas_id'];
}
