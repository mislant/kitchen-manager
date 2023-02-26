<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Utils;

use Kitman\Domain\Exception\InvalidArgumentException;
use Kitman\Domain\Model\Recipe\Ingredient;
use Kitman\Domain\Model\Recipe\IngredientType;
use Kitman\Domain\Model\Recipe\Recipe;

final class RecipeBuilder
{
    /** @var IngredientDto[] */
    private array $ingredients = [];

    public function __construct(
        private string $title = '',
        private int $calories = 0,
        private string $description = ''
    ) {
    }

    public static function default(): self
    {
        return new self("Dish", 100, "Test dish");
    }

    public function title(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function calories(int $calories): self
    {
        $this->calories = $calories;
        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    public function ingredient(): IngredientBuilder
    {
        return IngredientBuilder::default()
            ->ofRecipe($this);
    }

    public function addIngredient(IngredientDto $ingredient): void
    {
        $this->ingredients[] = $ingredient;
    }

    /** @throws InvalidArgumentException */
    public function build(): Recipe
    {
        $recipe = Recipe::new(
            $this->title,
            $this->calories,
            $this->description
        );

        foreach ($this->ingredients as $ingredient) {
            $recipe->addIngredient(
                $ingredient->name,
                $ingredient->amount,
                $ingredient->type
            );
        }

        return $recipe;
    }
}