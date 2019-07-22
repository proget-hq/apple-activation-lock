<?php

declare(strict_types=1);

namespace Proget\Apple\ActivationLock;

class ActivationLockKeyGenerator
{
    private const CHARSET = '0123456789ACDEFGHJKLMNPQRTUVWXYZ';
    private const BITS_INPUT = 128;
    private const BITS_PER_BYTE = 8;
    private const BITS_PER_SYMBOL = 5;
    private const DASH_POSITIONS = [5, 10, 14, 18, 22];

    public function generate(Bytes $bytes): string
    {
        $bitsProcessed = $bitOffsetIntoByte = $idx = $dashIdx = 0;
        $key = '';

        while ($bitsProcessed <= (self::BITS_INPUT - self::BITS_PER_SYMBOL)) {
            $bitsThisByte = ($bitOffsetIntoByte < self::BITS_PER_BYTE - self::BITS_PER_SYMBOL ? self::BITS_PER_SYMBOL : self::BITS_PER_BYTE - $bitOffsetIntoByte);
            $bitsNextByte = ($bitsThisByte < self::BITS_PER_SYMBOL ? self::BITS_PER_SYMBOL - $bitsThisByte : 0);

            $value = ($bytes->at($idx) << $bitOffsetIntoByte & 0xFF) >> (self::BITS_PER_BYTE - $bitsThisByte);

            $bitOffsetIntoByte += self::BITS_PER_SYMBOL;
            if ($bitOffsetIntoByte >= self::BITS_PER_BYTE) {
                $bitOffsetIntoByte -= self::BITS_PER_BYTE;
                ++$idx;
            }

            if ($bitsNextByte) {
                $value <<= $bitsNextByte;
                $value |= ($bytes->at($idx) >> (self::BITS_PER_BYTE - $bitsNextByte));
            }

            $key .= self::CHARSET[$value];
            if ((\strlen($key) - $dashIdx) === @self::DASH_POSITIONS[$dashIdx]) {
                $key .= '-';
                ++$dashIdx;
            }

            $bitsProcessed += self::BITS_PER_SYMBOL;
        }

        $bitsRemaining = self::BITS_INPUT - $bitsProcessed;
        if ($bitsRemaining) {
            $value = (($bytes->at($idx) << $bitOffsetIntoByte & 0xFF) >> (self::BITS_PER_BYTE - $bitsRemaining));
            $key .= self::CHARSET[$value];
        }

        return $key;
    }
}
