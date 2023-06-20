<?php

namespace App\Services\UseCases;

use App\Models\User;
use App\Repositories\User\UserRepositoryInterface;

class FindUserByIdService
{
    protected UserRepositoryInterface $userRepository;

    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function execute(int $id): ?User
    {
        return $this->userRepository->findById($id);
    }
}
