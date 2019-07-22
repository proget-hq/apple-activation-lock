<?php

declare(strict_types=1);

namespace Proget\Apple\ActivationLock;

class ActivationLockRandomBytesGenerator
{
    private const RANDOM_BYTES_LENGTH = 16;

    public function generate(): Bytes
    {
        $rawBytes = \openssl_random_pseudo_bytes(self::RANDOM_BYTES_LENGTH);
        if ($rawBytes === false) {
            throw ActivationLockException::couldNotGenerateRandomBytes();
        }

        return Bytes::fromString($rawBytes);
    }
}
