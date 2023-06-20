<?php

namespace App\Services\UseCases;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class CreateNewUserService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function execute(array $data): User
    {
        return $this->userRepository->create($data);
    }
}
