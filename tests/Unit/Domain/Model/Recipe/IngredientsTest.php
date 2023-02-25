<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Domain\Model\Recipe;

use Codeception\Test\Unit;
use Kitman\Domain\Model\Recipe\Ingredient;
use Kitman\Domain\Model\Recipe\Ingredients;

final class IngredientsTest extends Unit
{
    public function testSearchesIngredientsByName(): void
    {
        $ingredients = new Ingredients([
            Ingredient::solid("butter", 100),
            Ingredient::solid("sugar", 100),
        ]);

        $hasButter = $ingredients->has('butter');
        $hasSugar = $ingredients->has('sugar');
        $notOil = $ingredients->has('oil');

        $this->assertTrue($hasButter);
        $this->assertTrue($hasSugar);
        $this->assertFalse($notOil);
    }
}