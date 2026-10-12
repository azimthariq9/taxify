<?php

namespace App\Http\Controllers\Api;

use App\Models\Efaktur;

class EfakturController extends ApiController
{
    protected string $model = Efaktur::class;

    protected array $rules = [
        'nomor_seri' => 'required|string|max:30',
        'jenis_faktur' => 'nullable|in:Keluaran,Masukan',
        'tanggal_faktur' => 'required|date',
        'kode_transaksi' => 'nullable|string|max:5',
        'npwp_lawan' => 'required|string|max:25',
        'nama_lawan' => 'required|string',
        'alamat_lawan' => 'nullable|string',
        'dpp' => 'nullable|numeric|min:0',
        'ppn' => 'nullable|numeric|min:0',
        'ppnbm' => 'nullable|numeric|min:0',
        'masa_pajak' => 'required|string|max:20',
        'tahun_pajak' => 'required|string|size:4',
        'status' => 'nullable|in:Normal,Batal,Diganti',
        'keterangan' => 'nullable|string',
        'akun_id' => 'required|integer',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['nomor_seri', 'npwp_lawan', 'nama_lawan', 'masa_pajak'];

    protected array $filterable = ['user_id', 'akun_id', 'jenis_faktur', 'status', 'masa_pajak'];
}
