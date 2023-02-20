<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Kitman\Domain\Exception\EntityNotFound;
use Kitman\Domain\Exception\PersistException;
use Kitman\Domain\Model\Uuid;

interface RecipeRepository
{
    /** @throws PersistException<Recipe> */
    public function persist(Recipe $recipe): void;

    public function existsByName(string $name): bool;

    /** @throws EntityNotFound */
    public function getByUuid(Uuid $uuid): Recipe;
}