<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Persistence\Cycle\Repository;

use Kitman\Domain\Exception\EntityNotFound;
use Kitman\Domain\Exception\PersistException;
use Kitman\Domain\Model\Recipe\Recipe;
use Kitman\Domain\Model\Recipe\RecipeRepository;
use Kitman\Domain\Model\Uuid;

/** @template-extends AbstractRepository<Recipe> */
final class CycleRecipeRepository extends AbstractRepository implements RecipeRepository
{
    protected function entity(): string
    {
        return Recipe::class;
    }

    public function persist(Recipe $recipe): void
    {
        try {
            $this->transaction()
                ->persist($recipe)
                ->run();
        } catch (\Throwable $t) {
            throw new PersistException($recipe, $t);
        }
    }

    public function existsByName(string $name): bool
    {
        $recipe = $this->repository->findOne(['name' => $name]);
        return !is_null($recipe);
    }

    public function getByUuid(Uuid $uuid): Recipe
    {
        $recipe = $this->repository->findOne(['uuid' => (string)$uuid]);
        if (is_null($recipe)) {
            throw new EntityNotFound("Recipe", "uuid $uuid");
        }

        return $recipe;
    }
}