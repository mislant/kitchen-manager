<?php

declare(strict_types=1);

namespace Kitman\Application\Command\AddRecipe;

final class AddRecipeRequest
{
    public function __construct(
        public readonly string $name,
        public readonly float $calories,
        public readonly string $description
    ) {
    }
}