<?php

namespace App\EventListener;

use Doctrine\DBAL\Exception\UniqueConstraintViolationException;
use PHPUnit\Util\Json;
use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Validator\Exception\ValidationFailedException;

class ExceptionListener
{

    private LoggerInterface $logger;
    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    public function onKernelException(ExceptionEvent $event): void
    {
        $exception = $event->getThrowable();
        $message = sprintf("Error occurred: %s", $exception->getMessage());

        $errorMessage = $exception->getMessage();
        $errors = [];

        $responseCode = Response::HTTP_INTERNAL_SERVER_ERROR;

        $exceptionClass = get_class($exception);
        switch ($exceptionClass) {
            case ValidationFailedException::class:
                $responseCode = Response::HTTP_BAD_REQUEST;
                $violations = $exception->getViolations();
                foreach ($violations as $violation) {

                    $errors[] = [
                        'propertyPath' => $violation->getPropertyPath(),
                        'message' => $violation->getMessage(),
                    ];
                }
                $errorMessage = "Input Validation failed";

                break;
            case UniqueConstraintViolationException::class:
                $responseCode = Response::HTTP_UNPROCESSABLE_ENTITY;
                $errorMessage = "Email already exists";
                $errors [] = "Email already Exists";
        }

        $response = new JsonResponse([
            'errorMessage' => $errorMessage,
            'errors' => $errors,
//            "class" => $exceptionClass
        ], $responseCode);

        $this->logger->info($message);
        $event->setResponse($response);
    }
}