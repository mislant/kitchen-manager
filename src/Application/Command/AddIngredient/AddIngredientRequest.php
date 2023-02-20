<?php

declare(strict_types=1);

namespace Kitman\Application\Command\AddIngredient;

final class AddIngredientRequest
{
    public function __construct(
        public readonly string $recipeUuid,
        public readonly string $name,
        public readonly float $amount,
        public readonly string $type
    ) {
    }
}