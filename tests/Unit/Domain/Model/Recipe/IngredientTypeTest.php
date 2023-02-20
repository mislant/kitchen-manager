<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Domain\Model\Recipe;

use Codeception\Test\Unit;
use Kitman\Domain\Exception\InvalidArgumentException;
use Kitman\Domain\Model\Recipe\IngredientType;

final class IngredientTypeTest extends Unit
{
    public function testCastFromString(): void
    {
        $type = IngredientType::cast('liquid');

        $this->assertEquals(IngredientType::liquid, $type);
    }

    public function testExceptionOnWrongCastString(): void
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage("There is no ingredient type bread!");

        IngredientType::cast('bread');
    }
}