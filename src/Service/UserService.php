<?php

namespace App\Service;

use App\Repository\UserRepository;

class UserService
{
    public function __construct(protected UserRepository $personRepository)
    {
    }

    public function createUser(array $data): array
    {
        $this->personRepository->create($data);
    }
}