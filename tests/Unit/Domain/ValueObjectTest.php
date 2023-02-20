<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Domain;

use Codeception\Attribute\DataProvider;
use Codeception\Test\Unit;
use Kitman\Domain\Model\ValueObject;

abstract class ValueObjectTest extends Unit
{
    #[DataProvider('objects')]
    public function testComparisonLogic(ValueObject $first, ValueObject $second, bool $equals): void
    {
        $equals
            ? $this->assertEquals($first, $second)
            : $this->assertNotEquals($first, $second);
    }

    abstract public function objects(): array;
}