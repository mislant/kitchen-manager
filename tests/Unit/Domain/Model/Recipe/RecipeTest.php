<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Domain\Model\Recipe;

use Codeception\Test\Unit;
use Kitman\Domain\Exception\InvalidArgumentException;
use Kitman\Domain\Model\Recipe\Ingredient;
use Kitman\Domain\Model\Recipe\IngredientType;
use Kitman\Tests\Unit\Utils\RecipeBuilder;

final class RecipeTest extends Unit
{
    public function testCannotCreateRecipeWithLongName(): void
    {
        $title = str_repeat("Verylongname", 10);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Recipe name too long. Allowed 80 characters: " .
            strlen($title) .
            ' given!'
        );

        RecipeBuilder::default()
            ->title($title)
            ->build();
    }

    public function testAddingRecipe(): void
    {
        $recipe = RecipeBuilder::default()->build();

        $recipe->addIngredient('Oil', 200, IngredientType::liquid);
        $recipe->addIngredient('Flour', 100, IngredientType::solid);

        $ingredients = $recipe->ingredients();
        $this->assertInstanceOf(Ingredient::class, $ingredients[0]);
        $this->assertEquals(Ingredient::liquid('Oil', 200), $ingredients[0]);
        $this->assertEquals(Ingredient::solid('Flour', 100), $ingredients[1]);
        $this->assertCount(2, $ingredients);
    }
}