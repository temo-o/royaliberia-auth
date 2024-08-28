<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use App\Utilities\DTOHandler;

abstract class AbstractController
{
    protected DTOHandler $DTOHandler;
    public function __construct(DTOHandler $DTOHandler)
    {
        $this->DTOHandler = $DTOHandler;
    }

    /**
     * @throws \JsonException
     */
    public function getRequestPayload(Request $request): array
    {
        return \json_decode(json: $request->getContent(), associative: true, flags: JSON_THROW_ON_ERROR);
    }
}