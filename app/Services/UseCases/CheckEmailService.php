<?php

namespace App\Services\UseCases;

use App\Repositories\User\UserRepositoryInterface;

class CheckEmailService
{
    public function __construct(protected UserRepositoryInterface $userRepository)
    {
    }

    public function execute(string $email): bool
    {
        $user = $this->userRepository->findByEmail($email);
        if ($user) {
            return true;
        }
        return false;
    }
}
