<?php

namespace App\Http\Controllers\Api;

use App\Models\Pembayaran;

class PembayaranController extends ApiController
{
    protected string $model = Pembayaran::class;

    protected array $rules = [
        'id_spt' => 'nullable|integer|exists:spt_edit,id',
        'id_billing' => 'required|integer',
        'pajak_penghasilan' => 'nullable|numeric|min:0',
        'tanggal_bayar' => 'nullable|date',
        'status_bayar' => 'nullable|in:BELUM BAYAR,MENUNGGU,LUNAS',
        'metode_bayar' => 'nullable|string|max:50',
        'bukti_bayar' => 'nullable|string|max:255',
        'masa_pajak' => 'nullable|string|max:20',
        'npwp' => 'nullable|string|max:20',
        'nama' => 'nullable|string|max:100',
        'alamat' => 'nullable|string|max:255',
        'user_id' => 'required|integer|exists:users,id',
        'akun_id' => 'required|integer',
        'pemotong_id' => 'nullable|integer|exists:master_pemotong,id',
        'ntpn' => 'nullable|string|max:50',
    ];

    protected array $searchable = ['npwp', 'nama', 'ntpn', 'masa_pajak'];

    protected array $filterable = ['user_id', 'akun_id', 'status_bayar', 'id_spt'];
}
