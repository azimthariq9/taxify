<?php

namespace App\Http\Controllers\Api;

use App\Models\MasterAkun;

class MasterAkunController extends ApiController
{
    protected string $model = MasterAkun::class;

    protected array $rules = [
        'nama' => 'required|string|max:100',
        'npwp' => 'required|string|max:50',
        'nitku' => 'nullable|string|max:50',
        'alamat' => 'required|string',
        'tipe' => 'required|in:Orang Pribadi,Badan',
        'email' => 'required|email|max:100',
        'negara' => 'required|string|max:50',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['nama', 'npwp', 'email'];

    protected array $filterable = ['tipe', 'user_id', 'negara'];
}
