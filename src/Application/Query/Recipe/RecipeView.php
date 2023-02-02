<?php

declare(strict_types=1);

namespace Kitman\Application\Query\Recipe;

final class RecipeView
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $title,
        public readonly float $calories,
        public readonly string $description
    ) {
    }
}