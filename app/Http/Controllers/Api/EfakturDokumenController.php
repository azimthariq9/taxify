<?php

namespace App\Http\Controllers\Api;

use App\Models\EfakturDokumen;

class EfakturDokumenController extends ApiController
{
    protected string $model = EfakturDokumen::class;

    protected array $rules = [
        'akun_id' => 'required|integer|exists:master_pemotong,id',
        'arah' => 'required|in:keluaran,masukan',
        'kategori' => 'nullable|in:faktur,dokumen_lain',
        'npwp_lawan' => 'nullable|string|max:32',
        'nama_lawan' => 'nullable|string',
        'kode_transaksi' => 'nullable|string|max:10',
        'nomor_dokumen' => 'nullable|string|max:50',
        'tanggal_dokumen' => 'nullable|date',
        'masa_pajak' => 'nullable|integer|min:1|max:12',
        'tahun_pajak' => 'nullable|integer|min:1000|max:9999',
        'dpp' => 'nullable|numeric|min:0',
        'ppn' => 'nullable|numeric|min:0',
        'ppnbm' => 'nullable|numeric|min:0',
        'status' => 'nullable|in:draft,approved,amended,canceled',
        'esign_status' => 'nullable|in:belum,sudah',
        'is_kredit' => 'nullable|integer|in:0,1',
        'is_retur' => 'nullable|integer|in:0,1',
        'file_path' => 'nullable|string|max:255',
        'sumber' => 'nullable|in:manual,upload',
        'catatan' => 'nullable|string|max:255',
        'user_id' => 'required|integer|exists:users,id',
    ];

    protected array $searchable = ['nomor_dokumen', 'npwp_lawan', 'nama_lawan'];

    protected array $filterable = [
        'akun_id', 'user_id', 'arah', 'kategori', 'status', 'is_retur', 'masa_pajak',
    ];
}
