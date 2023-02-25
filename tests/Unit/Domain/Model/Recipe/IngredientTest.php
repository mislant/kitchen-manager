<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Domain\Model\Recipe;

use Kitman\Domain\Model\Recipe\Ingredient;
use Kitman\Tests\Unit\Domain\ValueObjectTest;

final class IngredientTest extends ValueObjectTest
{
    public function objects(): array
    {
        return [
            [Ingredient::solid('Flour', 100), Ingredient::solid('Flour', 100), true],
            [Ingredient::solid('Flour', 100), Ingredient::solid('Flour', 140), false],
            [Ingredient::solid('Flour', 100), Ingredient::liquid('Oil', 200), false],
        ];
    }

    public function testCheckNameIsSame(): void
    {
        $ingredient = Ingredient::solid("butter", 100);

        $same = $ingredient->nameIs('butter');
        $not = $ingredient->nameIs('oil');

        $this->assertTrue($same);
        $this->assertFalse($not);
    }
}