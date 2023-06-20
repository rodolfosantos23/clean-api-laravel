<?php

namespace App\Repositories\User;

use App\Models\User;

interface UserRepositoryInterface
{
    public function create(array $data): User;
    public function findById(int $id): ?User;
    public function findAll(?int $offset, ?int $limit): ?iterable;
    public function findByEmail(string $email): ?User;
}
