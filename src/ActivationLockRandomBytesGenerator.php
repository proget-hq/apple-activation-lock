<?php

declare(strict_types=1);

namespace Proget\Apple\ActivationLock;

class ActivationLockRandomBytesGenerator
{
    private const RANDOM_BYTES_LENGTH = 16;

    public function generate(): Bytes
    {
        try {
            $rawBytes = \openssl_random_pseudo_bytes(self::RANDOM_BYTES_LENGTH);
        } catch (\Exception $e) {
            throw ActivationLockException::couldNotGenerateRandomBytes();
        }

        return Bytes::fromString((string) $rawBytes);
    }
}
