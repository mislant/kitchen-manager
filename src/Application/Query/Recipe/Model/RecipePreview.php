<?php

declare(strict_types=1);

namespace Kitman\Application\Query\Recipe\Model;

final class RecipePreview
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $name,
        public readonly float $calories,
        public readonly string $description
    ) {
    }
}