<?php

declare(strict_types=1);

namespace Proget\Tests\Apple\ActivationLock;

use PHPUnit\Framework\TestCase;
use Proget\Apple\ActivationLock\ActivationLockException;
use Proget\Apple\ActivationLock\Bytes;

final class BytesTest extends TestCase
{
    public function testItCanBeCreatedFromString(): void
    {
        $bytes = Bytes::fromString('raw');

        self::assertSame('raw', $bytes->raw());
        self::assertSame(114, $bytes->at(0));
        self::assertSame(97, $bytes->at(1));
        self::assertSame(119, $bytes->at(2));
    }

    public function testItThrowsOutOfBoundsException(): void
    {
        $bytes = Bytes::fromString('raw');

        $this->expectExceptionObject(ActivationLockException::byteIndexOutOfBounds(4));
        $bytes->at(4);
    }
}
