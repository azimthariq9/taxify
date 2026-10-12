# Migrasi `taxusakti.sql` (MySQL/MariaDB) → PostgreSQL (Laravel 12)

Dokumen ini menjelaskan bagaimana 27 tabel dari dump MySQL lama
(`C:\xampp\htdocs\etaxakti\taxusakti.sql`) diterjemahkan ke Laravel migration
di `database/migrations/`, beserta penyesuaian yang dilakukan.

---

## 1. Menjalankan

```bash
cd D:\taxify-v2\backend

# pastikan .env sudah benar (DB_CONNECTION=pgsql, DB_DATABASE, DB_USERNAME, DB_PASSWORD)
php artisan migrate --seed
```

`--seed` akan menjalankan `LegacyDataSeeder` yang mengisi data awal dari dump:
`users` (2), `master_akun` (1), `master_pemotong` (2), `master_soal` (1),
`praktikum_mandiri` (1), lengkap dengan hash password aslinya sehingga login
legacy tetap bisa dipakai.

Bila tabel sudah terlanjur dibuat tanpa data, jalankan ulang khusus seeder:

```bash
php artisan db:seed --class=LegacyDataSeeder
```

---

## 2. Urutan migration

| File | Tabel |
|---|---|
| `0001_01_01_000000_create_users_table` | `users`, `password_reset_tokens`, `sessions` |
| `0001_01_01_000001_create_cache_table` | `cache`, `cache_locks` |
| `0001_01_01_000002_create_jobs_table` | `jobs`, `job_batches`, `failed_jobs` |
| `2026_10_08_021639_create_personal_access_tokens_table` | `personal_access_tokens` (Sanctum) |
| `..._000001` | `master_akun` |
| `..._000002` | `master_pemotong` |
| `..._000003` | `master_soal` |
| `..._000004` | `praktikum_mandiri` |
| `..._000005` | `kelas` |
| `..._000006` | `kelas_user` |
| `..._000007` | `kelas_praktikum` |
| `..._000008` | `kelas_praktikum_files` |
| `..._000009` | `praktikum` |
| `..._000010` | `soal_praktikum` |
| `..._000011` | `pengumpulan` |
| `..._000012` | `spt_konsep` |
| `..._000013` | `spt_menunggu` |
| `..._000014` | `spt_edit` |
| `..._000015` | `spt_dilaporkan` |
| `..._000016` | `spt_a1` |
| `..._000017` | `spt_bpbpt` |
| `..._000018` | `spt_bpspt` |
| `..._000019` | `spt_wpln` |
| `..._000020` | `billing` |
| `..._000021` | `billing_mandiri` |
| `..._000022` | `pembayaran` |
| `..._000023` | `kode_billing` |
| `..._000024` | `efaktur` |
| `..._000025` | `efaktur_dokumen` |
| `..._000026` | `efaktur_retur` |
| `..._000027` | trigger `updated_at` (pengganti `ON UPDATE CURRENT_TIMESTAMP`) |

Nama tabel dan nama kolom **dipertahankan 100% sama** dengan skema legacy,
supaya porting kode PHP native tidak perlu mengubah query.

---

## 3. Penerjemahan tipe data

| MySQL / MariaDB | PostgreSQL |
|---|---|
| `int(11) ... AUTO_INCREMENT` | `serial` (`$table->increments()`) |
| `int(11)` | `integer` |
| `bigint(20)` | `bigint` |
| `smallint` / `tinyint(2)` | `smallint` |
| `tinyint(1)` (mis. `is_active`, `is_retur`, `is_kredit`) | `smallint` — sengaja **bukan** `boolean`, agar pembacaan nilai 0/1 oleh PHP tetap sama seperti MySQL |
| `decimal(15,2)` / `numeric` | `numeric(15,2)` (`$table->decimal()`) |
| `double` | `double precision` (`$table->double()`) |
| `varchar(n)` / `char(n)` | `varchar(n)` / `char(n)` |
| `text`, `mediumtext`, `longtext` | `text` (PostgreSQL tidak punya batas ukuran) |
| `enum(...)` | `varchar(255) CHECK (kolom IN (...))` — Laravel `enum()` pada driver pgsql otomatis membuat CHECK constraint |
| `longtext CHECK (json_valid(...))` | `jsonb` (`spt_konsep.sumber_data_json`) |
| `timestamp DEFAULT current_timestamp()` | `timestamp DEFAULT current_timestamp()` (`->useCurrent()`) |
| `... ON UPDATE current_timestamp()` | trigger `trg_<tabel>_set_updated_at` |
| `ENGINE=InnoDB ... CHARSET=utf8mb4` | dihapus (PostgreSQL selalu UTF-8) |

---

## 4. Penyesuaian yang perlu diketahui

### 4.1 Nama index harus unik satu schema
Di MySQL nama index berlaku per tabel; di PostgreSQL berlaku per schema.
Dua nama yang bertabrakan sudah diganti:

| Tabel | Nama asli (MySQL) | Nama baru (pgsql) |
|---|---|---|
| `kelas_user` | `user_id` (UNIQUE) | `uq_kelas_user_user_kelas` |
| `pengumpulan` | `user_id` (KEY) | `idx_pengumpulan_user_id` |

Dua unique key duplikat pada `billing.kode_billing` (`kode_billing` +
`uq_kode_billing`) disatukan menjadi satu: `uq_kode_billing`.
Seluruh nama foreign key tetap sama dengan dump.

### 4.2 `created_by` bernilai 0
`kelas.created_by` dan `kelas_praktikum.created_by` didefinisikan
`NOT NULL DEFAULT 0` tetapi sekaligus punya FK ke `users.id` — di database mana
pun memasukkan `0` akan gagal karena tidak ada user id 0. Kedua kolom dibuat
**nullable** (FK tetap utuh, `ON DELETE CASCADE`).

### 4.3 Kolom yang tidak punya foreign key tetap tanpa FK
Sesuai skema asli, kolom seperti `master_pemotong.akun_id`,
`soal_praktikum.praktikum_id`, `praktikum.user_id`,
`efaktur.akun_id`, `billing.akun_id`, `spt_*.user_id` **tidak** dibuatkan FK
hanya index biasa (persis seperti dump).

### 4.4 Trigger `updated_at`
PostgreSQL tidak mengenal `ON UPDATE CURRENT_TIMESTAMP`. Migration
`2026_10_12_000027_add_updated_at_triggers` membuat fungsi
`taxify_set_updated_at()` dan trigger `BEFORE UPDATE` pada tabel:
`efaktur`, `efaktur_dokumen`, `kelas`, `spt_bpspt`, `spt_edit`.

### 4.5 `users` ditambah kolom Laravel
Skema legacy tidak punya `remember_token` dan `updated_at`; keduanya ditambahkan
(nullable) agar guard & Sanctum berfungsi. Kolom `fullname`, `username`,
`verification_token`, `role` tetap dipertahankan.

### 4.6 Sekuens setelah seed
Insert data legacy memakai id eksplisit (1, 2, ...). `LegacyDataSeeder` menyetel
ulang sekuens (`setval(pg_get_serial_sequence(...))`) supaya insert berikutnya
tidak bentrok primary key — masalah khas PostgreSQL.

---

## 5. Ringkasan API

Prefix: `/api` — autentikasi: `Authorization: Bearer <token>` (Sanctum).

### Autentikasi
| Method | Endpoint | Keterangan |
|---|---|---|
| POST | `/api/auth/register` | registrasi, langsung dapat token |
| POST | `/api/auth/login` | `login` = email **atau** username |
| GET | `/api/auth/me` | profil user login |
| POST | `/api/auth/logout` | cabut token aktif |

### Resource CRUD (27 resource)
Semua mendukung `GET (list)`, `POST`, `GET /{id}`, `PUT|PATCH /{id}`, `DELETE /{id}`:

```
users, master-akun, master-pemotong, master-soal, praktikum-mandiri,
kelas, kelas-user, kelas-praktikum, kelas-praktikum-files, praktikum,
soal-praktikum, pengumpulan, spt-konsep, spt-menunggu, spt-edit,
spt-dilaporkan, spt-a1, spt-bpbpt, spt-bpspt, spt-wpln, billing,
billing-mandiri, pembayaran, kode-billing, efaktur, efaktur-dokumen,
efaktur-retur
```

Parameter list (GET):

| Parameter | Fungsi |
|---|---|
| `?search=` | pencarian `ILIKE` pada kolom `$searchable` |
| `?<kolom>=` | filter tepat pada kolom `$filterable` |
| `?sort=` / `?direction=asc\|desc` | pengurutan (kolom harus searchable/filterable/pk) |
| `?per_page=` | 1–100, default 15 (bentuk respons: paginator Laravel) |

Contoh:

```
GET /api/spt-a1?search=3175&status=Terbit&sort=id&direction=desc&per_page=20
GET /api/master-akun
POST /api/billing  (JSON: kode_billing, pajak_penghasilan, masa_pajak, user_id, akun_id)
```

`GET /api/health` tetap tersedia tanpa token untuk mengecek koneksi database.

---

## 6. Struktur kode

```
app/Http/Controllers/Api/
├── ApiController.php        # CRUD generik: index/store/show/update/destroy + search & filter
├── AuthController.php       # register/login/me/logout (Sanctum)
└── <Resource>Controller.php # cukup isi $model, $rules, $searchable, $filterable

app/Models/                  # 27 model, nama tabel & kolom persis skema legacy
database/migrations/         # 31 file
database/seeders/LegacyDataSeeder.php
```

Menambah resource baru cukup:

```php
class BaruController extends ApiController
{
    protected string $model = \App\Models\Baru::class;
    protected array $rules = ['nama' => 'required|string'];
    protected array $searchable = ['nama'];
    protected array $filterable = ['user_id'];
}
```

lalu daftarkan `Route::apiResource('baru', BaruController::class);` di
`routes/api.php`.
