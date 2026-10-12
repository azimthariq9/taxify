<?php

namespace App\Http\Controllers\Api;

use App\Models\Billing;

class BillingController extends ApiController
{
    protected string $model = Billing::class;

    protected array $rules = [
        'kode_billing' => 'required|string|max:20',
        'spt_id' => 'nullable|integer|exists:spt_edit,id',
        'pajak_penghasilan' => 'required|numeric|min:0',
        'masa_pajak' => 'required|string|max:20',
        'user_id' => 'required|integer|exists:users,id',
        'akun_id' => 'required|integer',
        'pemotong_id' => 'nullable|integer|exists:master_pemotong,id',
    ];

    protected array $searchable = ['kode_billing', 'masa_pajak'];

    protected array $filterable = ['user_id', 'akun_id', 'pemotong_id', 'spt_id'];
}
