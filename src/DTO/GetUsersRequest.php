<?php

namespace App\DTO;

use App\DTO\Interfaces\RequestDtoInterface;
use Symfony\Component\Validator\Constraints as Assert;

class GetUsersRequest implements RequestDtoInterface
{
    #[Assert\Type("int")]
    public int $userId;
}