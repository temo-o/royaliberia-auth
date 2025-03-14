<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\{Request, Response};
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\CurrentUser;
use App\Entity\User;


class ApiLoginController extends AbstractController
{
    #[Route('login', name: 'api_login', methods: ['POST'])]
    public function index(#[CurrentUser] ?User $user): Response
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the security system.');
    }

    #[Route('check_login', name: 'check_login', methods: ['POST'])]
    public function checkToken(Request $request): Response
    {
        return $this->json([
           'user' => $this->getUser()
        ]);
    }
}