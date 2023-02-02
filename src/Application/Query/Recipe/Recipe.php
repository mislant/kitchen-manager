<?php

declare(strict_types=1);

namespace Kitman\Application\Query\Recipe;

final class Recipe
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $name,
        public readonly float $calories,
        public readonly string $description
    ) {
    }
}