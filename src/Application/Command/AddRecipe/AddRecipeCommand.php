<?php

declare(strict_types=1);

namespace Kitman\Application\Command\AddRecipe;

use Kitman\Domain\Exception\PersistException;
use Kitman\Domain\Model\Recipe\Recipe;
use Kitman\Domain\Model\Recipe\RecipeExists;
use Kitman\Domain\Model\Recipe\RecipeRepository;

final class AddRecipeCommand
{
    public function __construct(
        private readonly RecipeRepository $repository
    ) {
    }

    /**
     * @throws RecipeExists
     * @throws PersistException
     */
    public function __invoke(AddRecipeRequest $request): void
    {
        if ($this->repository->existsByTitle($request->name)) {
            throw new RecipeExists($request->name);
        }

        $recipe = Recipe::new(
            $request->name,
            $request->calories,
            $request->description
        );

        $this->repository->persist($recipe);
    }
}