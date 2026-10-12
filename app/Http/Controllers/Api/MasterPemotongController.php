<?php

namespace App\Http\Controllers\Api;

use App\Models\MasterPemotong;

class MasterPemotongController extends ApiController
{
    protected string $model = MasterPemotong::class;

    protected array $rules = [
        'nama' => 'required|string',
        'tipe' => 'required|in:Orang Pribadi,Badan',
        'is_active' => 'nullable|integer|in:0,1',
        'npwp' => 'nullable|string|max:32',
        'alamat' => 'nullable|string',
        'email' => 'nullable|email',
        'negara' => 'nullable|string|max:100',
        'akun_id' => 'nullable|integer|exists:master_akun,id',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['nama', 'npwp', 'email'];

    protected array $filterable = ['tipe', 'user_id', 'akun_id', 'is_active'];
}
