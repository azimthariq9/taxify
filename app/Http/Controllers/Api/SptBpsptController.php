<?php

namespace App\Http\Controllers\Api;

use App\Models\SptBpspt;

class SptBpsptController extends ApiController
{
    protected string $model = SptBpspt::class;

    protected array $rules = [
        'masa_pajak' => 'nullable|string|max:20',
        'periode_bulan' => 'nullable|string|max:20',
        'periode_tahun' => 'nullable|string|max:4',
        'nomor_pemotongan' => 'nullable|string|max:50',
        'status' => 'nullable|string|max:20',
        'nitku' => 'nullable|string|max:100',
        'jenis_pajak' => 'nullable|string|max:100',
        'kode_pajak' => 'nullable|string|max:50',
        'npwp' => 'nullable|string|max:30',
        'nama' => 'nullable|string|max:100',
        'alamat' => 'nullable|string|max:255',
        'status_ptkp' => 'nullable|string|max:20',
        'dasar_pengenaan_pajak' => 'nullable|numeric|min:0',
        'pajak_penghasilan' => 'nullable|numeric|min:0',
        'fasilitas_pajak' => 'nullable|string|max:100',
        'created_by' => 'nullable|string',
        'pemotong_nama' => 'nullable|string',
        'pemotong_alamat' => 'nullable|string',
        'user_id' => 'required|integer|exists:users,id',
        'akun_id' => 'nullable|integer',
        'nama_objek' => 'nullable|string',
        'sifat_penghasilan' => 'nullable|string',
        'kap' => 'nullable|string|max:50',
        'penghasilan_bruto' => 'nullable|numeric|min:0',
        'dpp' => 'nullable|numeric|min:0',
        'tarif' => 'nullable|numeric|min:0',
        'jenis_dokumen' => 'nullable|string',
        'nomor_dokumen' => 'nullable|string',
        'tanggal_mulai' => 'nullable|date',
        'nomor_sub_unit' => 'nullable|string',
        'kode_objek' => 'nullable|string|max:100',
    ];

    protected array $searchable = ['npwp', 'nama', 'nomor_pemotongan', 'masa_pajak', 'nama_objek'];

    protected array $filterable = ['user_id', 'akun_id', 'status', 'masa_pajak'];
}
