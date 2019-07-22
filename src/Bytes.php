<?php

declare(strict_types=1);

namespace Proget\Apple\ActivationLock;

final class Bytes
{
    /**
     * @var string
     */
    private $raw;

    /**
     * @var int[]
     */
    private $bytes;

    private function __construct()
    {
    }

    public static function fromString(string $rawBytes): self
    {
        $self = new self();
        $self->raw = $rawBytes;

        foreach (\str_split($rawBytes) as $rawByte) {
            $self->bytes[] = \ord($rawByte);
        }

        return $self;
    }

    public function at(int $index): int
    {
        if (!isset($this->bytes[$index])) {
            throw ActivationLockException::byteIndexOutOfBounds($index);
        }

        return $this->bytes[$index];
    }

    public function raw(): string
    {
        return $this->raw;
    }
}
