<?php

namespace App\Service;

use Random\RandomException;
use WebToken\JWT\JWT;
use WebToken\JWT\Signer\Hmac\Sha256;
use WebToken\JWT\Signer\Key\InMemory;

class AccessTokenService
{
    private string $secretKey;
    public function __construct()
    {
//        $this->secretKey = 'someSecretKey';
    }

    /**
     * @throws RandomException
     */
    public function generateAccessToken(): string
    {
        return bin2hex(random_bytes(32));
    }

}