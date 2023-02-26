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
        foreach ($this->collection as $ingredient) {
            if ($ingredient->nameIs($name)) {
                return true;
            }
        }
        return false;
    }

    public function get(string $name): ?Ingredient
    {
        foreach ($this->collection as $ingredient) {
            if ($ingredient->nameIs($name)) {
                return $ingredient;
            }
        }
        return null;
    }

    public function remove(string $name): void
    {
        foreach ($this->collection as $index => $ingredient) {
            if ($ingredient->nameIs($name)) {
                unset($this[$index]);
                return;
            }
        }
    }
}