<?php

namespace App\Repository;

use App\Entity\AccessToken;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class AccessTokenRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, AccessToken::class);
    }

    /**
     * Finds an AccessToken by its value.
     * @param string $value The value of the access token.
     * @return AccessToken|null Returns the AccessToken object if found, or null otherwise.
     */
    public function findOneByValue(string $value): ?AccessToken
    {
        return $this->findOneBy(['value' => $value]);
    }
}
