<?php

namespace App\Http\Controllers\Api;

use App\Models\BillingMandiri;

class BillingMandiriController extends ApiController
{
    protected string $model = BillingMandiri::class;

    protected array $rules = [
        'npwp' => 'required|string|max:25',
        'nama_wp' => 'required|string|max:100',
        'alamat_wp' => 'nullable|string|max:255',
        'kap_kjs' => 'required|string|max:20',
        'periode' => 'required|string|size:2',
        'tahun' => 'required|string|size:4',
        'masa_pajak' => 'required|string|max:20',
        'nominal' => 'required|numeric|min:0',
        'terbilang' => 'nullable|string|max:255',
        'jumlah_pajak' => 'nullable|numeric|min:0',
        'status' => 'nullable|in:Draft,Dibayar',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['npwp', 'nama_wp', 'kap_kjs', 'masa_pajak'];

    protected array $filterable = ['user_id', 'status', 'tahun', 'periode'];
}
