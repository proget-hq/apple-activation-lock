<?php

declare(strict_types=1);

namespace Proget\Apple\ActivationLock;

final class ActivationLockException extends \Exception
{
    public static function byteIndexOutOfBounds(int $index): self
    {
        return new self(\sprintf('Byte index %d out of bounds', $index));
    }

    public static function couldNotGenerateRandomBytes(?\Throwable $dueTo = null): self
    {
        return new self('Could not generate random bytes', 0, $dueTo);
    }
}
