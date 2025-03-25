<?php

namespace App\Security;

use Lexik\Bundle\JWTAuthenticationBundle\{Exception\JWTEncodeFailureException,
    Services\JWTManager,
    Services\JWTTokenManagerInterface};
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\{JsonResponse, Response, Request};
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;

class JWTAuthenticationSuccessHandler implements AuthenticationSuccessHandlerInterface
{
    private JWTManager $jwtManager;
    private Security $security;

    public function __construct(JWTTokenManagerInterface $jwtManager, Security $security)
    {
        $this->jwtManager = $jwtManager;
        $this->security = $security;
    }

    /**
     * @throws JWTEncodeFailureException
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token): Response
    {
        $user = $this->security->getUser();
        $payload = [
            'id' => $user->getId(),
            'username' => $user->getUserIdentifier(),
            'roles' => $user->getRole(),
            'iat' => time(),
            'exp' => time() + 3600
        ];

        $token = $this->jwtManager->createFromPayload($user, $payload);

        return new JsonResponse(['token' => $token, 'payload' => $payload]);
    }
}
