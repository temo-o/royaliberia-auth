<?php

namespace App\Security;

use App\Repository\AccessTokenRepository;
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
use Symfony\Component\Security\Http\{AccessToken\AccessTokenHandlerInterface, Authenticator\Passport\Badge\UserBadge};

class AccessTokenHandler implements AccessTokenHandlerInterface
{

    public function __construct(public AccessTokenRepository $accessTokenRepository)
    {
    }

    public function getUserBadgeFrom(#[\SensitiveParameter] string $accessToken): UserBadge
    {
        $accessToken = $this->accessTokenRepository->findOneByValue($accessToken);

        if($accessToken === null || !$accessToken->isValid()) {
            throw new BadCredentialsException('Invalid credentials.');
        }

        return new UserBadge($accessToken->getUserId());
    }
}