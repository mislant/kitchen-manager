<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Utils;

use Kitman\Domain\Model\ValueObject;
use SebastianBergmann\Comparator\Comparator;
use SebastianBergmann\Comparator\ComparisonFailure;

final class ValueObjectComparator extends Comparator
{
    public function accepts($expected, $actual): bool
    {
        return $expected instanceof ValueObject &&
            $actual instanceof ValueObject;
    }

    /**
     * @param ValueObject $expected
     * @param ValueObject $actual
     * @throws ComparisonFailure
     */
    public function assertEquals(
        $expected,
        $actual,
        $delta = 0.0,
        $canonicalize = false,
        $ignoreCase = false
    ): void {
        if ($actual->equals($expected)) {
            throw new ComparisonFailure(
                $expected,
                $actual,
                $this->exporter->export($expected),
                $this->exporter->export($actual)
            );
        }
    }
}