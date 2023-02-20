<?php

declare(strict_types=1);

namespace Kitman\Tests\Story\Utils\Random;

use Kitman\Domain\Model\Recipe\IngredientType;

final class Ingredient
{
    private const TYPES = [
        IngredientType::countable,
        IngredientType::solid,
        IngredientType::liquid,
    ];

    public function name(): string
    {
        return uniqid("Ingr_", true);
    }

    public function type(): IngredientType
    {
        return self::TYPES[random_int(0, 2)];
    }

    public function amount(): float
    {
        return random_int(0, 1000);
    }
}