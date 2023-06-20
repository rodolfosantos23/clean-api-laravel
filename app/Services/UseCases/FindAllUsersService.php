<?php

namespace App\Services\UseCases;

use App\Repositories\User\UserRepositoryInterface;

class FindAllUsersService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function execute(?int $offset, ?int $limit): ?iterable
    {
        return $this->userRepository->findAll($offset, $limit);
    }
}
