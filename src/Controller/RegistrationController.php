<?php

namespace App\Controller;
use App\DTO\RegisterUserRequest;
use App\Service\RegistrationService;
use Symfony\Component\HttpFoundation\{JsonResponse, Request, Response};
use Symfony\Component\Routing\Attribute\Route;

class RegistrationController extends AbstractController
{
    /**
     * @param Request $request
     * @param RegistrationService $registrationService
     * @return Response
     */
    #[Route('/registration', name: 'registration', methods: ['POST'])]
    public function register(
        Request $request,
        RegistrationService $registrationService,
    ): Response
    {
        $registerUserRequestDTO = $this->DTOHandler->createDTO($request, RegisterUserRequest::class);
        $registerUserResponse = $registrationService->registerUser($registerUserRequestDTO);

        return new JsonResponse($registerUserResponse);
    }
}