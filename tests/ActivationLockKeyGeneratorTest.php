<?php

declare(strict_types=1);

namespace Proget\Tests\Apple\ActivationLock;

use PHPUnit\Framework\TestCase;
use Proget\Apple\ActivationLock\ActivationLockException;
use Proget\Apple\ActivationLock\ActivationLockKeyGenerator;
use Proget\Apple\ActivationLock\Bytes;

final class ActivationLockKeyGeneratorTest extends TestCase
{
    public function testItGeneratesExpectedKey(): void
    {
        self::assertSame(
            'F9KQ2-XC9F9-KP8W-V9G9-KPKW-TJ66',
            (new ActivationLockKeyGenerator())->generate(Bytes::fromString('requiredsizeis16'))
        );
    }

    public function testItThrowsBytesExceptionWhenSizeIsTooShort(): void
    {
        $this->expectExceptionObject(ActivationLockException::byteIndexOutOfBounds(5));

        (new ActivationLockKeyGenerator())->generate(Bytes::fromString('short'));
    }
}
