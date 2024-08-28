<?php

namespace App\Repository;

use App\DTO\RegisterUserRequest;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserRepository
{
    public function __construct(
        protected EntityManagerInterface $em,
        protected UserPasswordHasherInterface $passwordHasher
    )
    {
    }

    public function create(RegisterUserRequest $request): User
    {
        $newUser = new User();
        $newUser->setStatusFlag(1);
        $newUser->setCreatedAt(new \DateTime());
        $newUser->setUpdatedAt(new \DateTime());
        $newUser->setEmail($request->email);
        $newUser->setFirstName($request->firstName);
        $newUser->setLastName($request->lastName);

        $passwordHash = $this->passwordHasher->hashPassword($newUser, $request->password);
        $newUser->setPassword($passwordHash);
        $this->em->persist($newUser);
        $this->em->flush();

        return $newUser;
    }
}