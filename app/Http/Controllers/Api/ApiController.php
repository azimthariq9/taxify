<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * CRUD dasar untuk seluruh resource API Taxify V2.
 *
 * Controller anak cukup mendefinisikan:
 *   - $model       : class-string<Model> (wajib)
 *   - $rules       : validasi saat create
 *   - $searchable  : kolom yang boleh di-*search* lewat ?search=
 *   - $filterable  : kolom yang boleh difilter lewat ?<kolom>=
 *   - $updateRules : opsional, bila kosong diturunkan dari $rules
 *
 * Endpoint yang dihasilkan per resource:
 *   GET    /<resource>            (paginate, ?search=&?kolom=&?sort=&?per_page=)
 *   POST   /<resource>
 *   GET    /<resource>/{id}
 *   PUT    /<resource>/{id}
 *   DELETE /<resource>/{id}
 */
abstract class ApiController extends Controller
{
    /** @var class-string<Model> */
    protected string $model;

    /** @var array<string, string> */
    protected array $rules = [];

    /** @var array<string, string> */
    protected array $updateRules = [];

    /** @var array<int, string> */
    protected array $searchable = [];

    /** @var array<int, string> */
    protected array $filterable = [];

    protected string $defaultSort = 'desc';

    /** Ambil query dasar (override untuk scope tenant/per-user). */
    protected function newQuery(): Builder
    {
        return $this->model::query();
    }

    public function index(Request $request): JsonResponse
    {
        $query = $this->newQuery();

        $this->applySearch($query, $request);
        $this->applyFilters($query, $request);
        $this->applySort($query, $request);

        $perPage = min(max((int) $request->integer('per_page', 15), 1), 100);

        return response()->json($query->paginate($perPage)->withQueryString());
    }

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate($this->rules);

        /** @var Model $model */
        $model = $this->model::query()->create($data);

        return response()->json($model, 201);
    }

    public function show(string $id): JsonResponse
    {
        return response()->json($this->findOrFail($id));
    }

    public function update(Request $request, string $id): JsonResponse
    {
        $model = $this->findOrFail($id);

        $model->fill($request->validate($this->updateRules()));
        $model->save();

        return response()->json($model);
    }

    public function destroy(string $id): JsonResponse
    {
        $this->findOrFail($id)->delete();

        return response()->json([
            'message' => 'Data berhasil dihapus.',
        ]);
    }

    protected function findOrFail(string $id): Model
    {
        return $this->newQuery()->findOrFail($id);
    }

    /**
     * Turunkan aturan update dari aturan create:
     * kolom `required` menjadi `sometimes` (nilai boleh tidak dikirim).
     *
     * @return array<string, string>
     */
    protected function updateRules(): array
    {
        if ($this->updateRules !== []) {
            return $this->updateRules;
        }

        $rules = [];

        foreach ($this->rules as $field => $rule) {
            $parts = array_map('trim', explode('|', $rule));
            $parts = array_map(
                fn (string $item) => $item === 'required' ? 'sometimes' : $item,
                $parts
            );

            $rules[$field] = implode('|', $parts);
        }

        return $rules;
    }

    protected function applySearch(Builder $query, Request $request): void
    {
        $search = trim((string) $request->query('search'));

        if ($search === '' || $this->searchable === []) {
            return;
        }

        $needle = '%'.$search.'%';

        // PostgreSQL pakai ILIKE (case-insensitive); MySQL & SQLite sudah
        // case-insensitive pada operator LIKE bawaannya.
        $operator = DB::getDriverName() === 'pgsql' ? 'ilike' : 'like';

        $query->where(function (Builder $inner) use ($needle, $operator) {
            foreach ($this->searchable as $column) {
                $inner->orWhere($column, $operator, $needle);
            }
        });
    }

    protected function applyFilters(Builder $query, Request $request): void
    {
        foreach ($this->filterable as $column) {
            $value = $request->query($column);

            if ($value === null || $value === '') {
                continue;
            }

            $query->where($column, $value);
        }
    }

    protected function applySort(Builder $query, Request $request): void
    {
        $sort = (string) $request->query('sort');
        $direction = strtolower((string) $request->query('direction', $this->defaultSort)) === 'asc'
            ? 'asc'
            : 'desc';

        $keyName = (new ($this->model)())->getKeyName();

        if ($sort !== '' && in_array($sort, array_merge($this->searchable, $this->filterable, [$keyName]), true)) {
            $query->orderBy($sort, $direction);

            return;
        }

        $query->orderBy($keyName, $this->defaultSort === 'asc' ? 'asc' : 'desc');
    }
}
