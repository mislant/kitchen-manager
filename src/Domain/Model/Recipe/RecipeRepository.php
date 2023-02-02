<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Kitman\Domain\Exception\PersistException;

interface RecipeRepository
{
    /** @throws PersistException<Recipe> */
    public function persist(Recipe $recipe): void;

    public function existsByName(string $name): bool;
}