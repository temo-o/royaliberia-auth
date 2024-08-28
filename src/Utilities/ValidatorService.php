<?php

namespace App\Utilities;

use App\DTO\Interfaces\BaseDTOInterface;
use Symfony\Component\Validator\{ConstraintViolationList, Validator\ValidatorInterface};

class ValidatorService
{
    public function __construct(protected ValidatorInterface $validator)
    {
    }

    public function validateRequest(BaseDTOInterface $dto): ConstraintViolationList
    {
        return $this->validator->validate($dto);
    }
}