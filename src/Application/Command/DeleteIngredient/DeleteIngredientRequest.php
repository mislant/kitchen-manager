<?php

declare(strict_types=1);

namespace Kitman\Application\Command\DeleteIngredient;

final class DeleteIngredientRequest
{
    public function __construct(
        public readonly string $uuid,
        public readonly string $ingredient,
    ) {
    }
}