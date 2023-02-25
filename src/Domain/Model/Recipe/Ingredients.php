<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Kitman\Domain\Model\Collection;

/** @template-extends Collection<Ingredient> */
final class Ingredients extends Collection
{
    public function of(): string
    {
        return Ingredient::class;
    }

    public function has(string $name): bool
    {
        return $this->collection->reduce(
            static function (bool $has, Ingredient $ingredient) use ($name): bool {
                return $has ?: $ingredient->nameIs($name);
            },
            false
        );
    }
}