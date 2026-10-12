<?php

namespace App\Http\Controllers\Api;

use App\Models\User;

class UserController extends ApiController
{
    protected string $model = User::class;

    protected array $rules = [
        'fullname' => 'required|string|max:100',
        'username' => 'required|string|max:50|alpha_dash|unique:users,username',
        'email' => 'required|email|max:100|unique:users,email',
        'password' => 'required|string|min:8|max:255',
        'role' => 'nullable|in:dosen,mahasiswa',
        'email_verified_at' => 'nullable|date',
        'verification_token' => 'nullable|string|max:255',
    ];

    protected array $updateRules = [
        'fullname' => 'sometimes|string|max:100',
        'username' => 'sometimes|string|max:50|alpha_dash|unique:users,username',
        'email' => 'sometimes|email|max:100|unique:users,email',
        'password' => 'sometimes|string|min:8|max:255',
        'role' => 'sometimes|in:dosen,mahasiswa',
        'email_verified_at' => 'nullable|date',
        'verification_token' => 'nullable|string|max:255',
    ];

    protected array $searchable = ['fullname', 'username', 'email'];

    protected array $filterable = ['role'];
}
