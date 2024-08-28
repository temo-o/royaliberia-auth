<?php

namespace App\DTO;

use App\DTO\Interfaces\BaseDTOInterface;
use Symfony\Component\Validator\Constraints as Assert;

class RegisterUserRequest implements BaseDTOInterface
{

    #[Assert\Email(message: 'Invalid email provided')]
    public string $email;
    #[Assert\PasswordStrength(
        minScore: Assert\PasswordStrength::STRENGTH_MEDIUM,
        message: 'Invalid password provided'
    )]
    public string $password;

    #[Assert\NotBlank(message: 'First Name is required')]
    public string $firstName;

    #[Assert\NotBlank(message: 'Last Name is required')]
    public string $lastName;
}