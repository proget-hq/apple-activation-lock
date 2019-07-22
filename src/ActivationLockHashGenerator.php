<?php

declare(strict_types=1);

namespace Proget\Apple\ActivationLock;

class ActivationLockHashGenerator
{
    private const HASH_LENGTH = 32;
    private const SALT = "\0\0\0\0";
    private const ROUNDS = 50000;

    public function generate(Bytes $bytes): string
    {
        return \implode('', \array_map(static function (string $byte): string {
            return \sprintf('%02X', \ord($byte));
        }, \str_split(\hash_pbkdf2('sha256', $bytes->raw(), self::SALT, self::ROUNDS, self::HASH_LENGTH, true))));
    }
}
