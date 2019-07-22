<?php

declare(strict_types=1);

namespace Proget\Tests\Apple\ActivationLock;

use PHPUnit\Framework\TestCase;
use Proget\Apple\ActivationLock\ActivationLockHashGenerator;
use Proget\Apple\ActivationLock\Bytes;

final class ActivationLockHashGeneratorTest extends TestCase
{
    public function testItGeneratesExpectedHash(): void
    {
        self::assertSame(
            'EFDA4B2BA02141FCF16E32B621904FCFEAAA881F3D563A781319330824A9405F',
            (new ActivationLockHashGenerator())->generate(Bytes::fromString('bytes'))
        );
    }
}
