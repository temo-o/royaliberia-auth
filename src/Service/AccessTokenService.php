<?php

namespace App\Service;

use Random\RandomException;

class AccessTokenService
{
    public function __construct()
    {
    }

    /**
     * @throws RandomException
     */
    public function generateAccessToken(): string
    {
        return bin2hex(random_bytes(32));
    }

}