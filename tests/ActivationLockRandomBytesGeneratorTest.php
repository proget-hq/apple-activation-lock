<?php

declare(strict_types=1);

namespace Proget\Tests\Apple\ActivationLock;

use PHPUnit\Framework\TestCase;
use Proget\Apple\ActivationLock\ActivationLockRandomBytesGenerator;

final class ActivationLockRandomBytesGeneratorTest extends TestCase
{
    public function testItCreatesRandomBytes(): void
    {
        $generator = new ActivationLockRandomBytesGenerator();
        $bytes1 = $generator->generate();
        $bytes2 = $generator->generate();

        self::assertSame(\strlen($bytes1->raw()), \strlen($bytes2->raw()));
        self::assertNotSame($bytes1, $bytes2);
    }
}
