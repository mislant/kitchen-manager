<?php

declare(strict_types=1);

namespace Kitman\Application\Command\AddIngredient;

use Kitman\Domain\Model\Recipe\IngredientType;
use Kitman\Domain\Model\Recipe\RecipeRepository;
use Kitman\Domain\Model\Uuid;

final class AddIngredientCommand
{
    public function __construct(
        private readonly RecipeRepository $repository
    ) {
    }

    public function __invoke(AddIngredientRequest $request): void
    {
        $recipe = $this->repository->getByUuid(
            Uuid::cast($request->recipeUuid)
        );

        $recipe->addIngredient(
            $request->name,
            $request->amount,
            IngredientType::cast($request->type)
        );

        $this->repository->persist($recipe);
    }
}