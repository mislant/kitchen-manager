<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Utils;

use Kitman\Domain\Model\Recipe\IngredientType;

final class IngredientDto
{
    public function __construct(
        public string $name = '',
        public IngredientType $type = IngredientType::liquid,
        public float $amount = 0
    ) {
    }
}