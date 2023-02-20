<?php

declare(strict_types=1);

namespace Kitman\Application\Query\Recipe\Model;

final class Ingredient
{
    public function __construct(
        public readonly string $name,
        public readonly float $amount,
        public readonly string $measure
    ) {
    }
}