<?php

namespace App\Controller;

use App\Service\AccessTokenService;
use Random\RandomException;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Repository\AccessTokenRepository;
use App\Entity\User;

class ApiLoginController extends AbstractController
{

    /**
     * @throws RandomException
     */
    #[Route('login', name: 'api_login', methods: ['POST'])]
    public function index(#[CurrentUser] ?User $user, AccessTokenService $accessTokenService): Response
    {
        if($user === null){
            return $this->json([
                'message' => 'missing credentials'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $accessTokenService->generateAccessToken();

        return $this->json([
            'user'  => $user->getId(),
            'token' => $token
        ]);
    }

}