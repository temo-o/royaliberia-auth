<?php

namespace App\Service;

use App\DTO\RegisterUserRequest;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Exception\ORMException;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class RegistrationService
{

    public function __construct(protected UserRepository $userRepository)
    {
    }

    public function registerUser(
        RegisterUserRequest $request
    ): User
    {
        return $this->userRepository->create($request);
    }
}