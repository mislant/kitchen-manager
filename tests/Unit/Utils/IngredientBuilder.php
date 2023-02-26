<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Utils;

use Kitman\Domain\Model\Recipe\IngredientType;

final class IngredientBuilder
{
    private ?RecipeBuilder $recipeBuilder = null;

    public function __construct(
        private string $name = '',
        private IngredientType $type = IngredientType::liquid,
        private float $amount = 0
    ) {
    }

    public static function default(): self
    {
        return new self(
            'milk',
            IngredientType::liquid,
            0
        );
    }

    public function ofRecipe(RecipeBuilder $recipeBuilder): self
    {
        $this->recipeBuilder = $recipeBuilder;
        return $this;
    }

    public function name(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    public function add(): RecipeBuilder
    {
        if (!isset($this->recipeBuilder)) {
            throw new \RuntimeException("Cannot add ingredient to recipe. RecipeBuilder not specified");
        }

        $this->recipeBuilder->addIngredient(
            new IngredientDto(
                $this->name,
                $this->type,
                $this->amount
            )
        );

        return $this->recipeBuilder;
    }
}