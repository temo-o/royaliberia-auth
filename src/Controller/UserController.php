<?php

namespace App\Controller;

use App\Service\UserService;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Attribute\Route;

class UserController extends AbstractController
{
    public function __construct(protected UserService $personService)
    {
    }

    /**
     * @throws \JsonException
     */
    #[Route('/ab', name: 'user', methods: ['GET'])]
    public function createUser(Request $request): Response
    {
        return  new JsonResponse(["foo"=>"bar"]);
    }
}