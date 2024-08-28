<?php

namespace App\Utilities;

use App\DTO\Interfaces\BaseDTOInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\Exception\NotEncodableValueException;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Validator\{Constraints\Valid, Exception\ValidationFailedException, Validator\ValidatorInterface};

use App\Utilities\ValidatorService;

class DTOHandler
{
    private SerializerInterface $serializer;
    private ValidatorInterface $validator;
    private ValidatorService  $validatorService;
    public function __construct(SerializerInterface $serializer, ValidatorInterface $validator, ValidatorService $validatorService){
        $this->serializer = $serializer;
        $this->validator = $validator;
        $this->validatorService = $validatorService;
    }

    public function createDTO(Request $request, string $dtoClass): BaseDTOInterface
    {
        $requestData = $request->getContent();

        try {
            $dto = $this->serializer->deserialize($requestData, $dtoClass, 'json');
        }
        catch (\Exception $exception){
            throw new NotEncodableValueException($exception->getMessage());
        }
        $violations = $this->validatorService->validateRequest($dto);
        //$violations = $this->validator->validate($dto);
        if (count($violations) > 0) {
            throw new ValidationFailedException([], $violations);
        }

        return $dto;
    }
}