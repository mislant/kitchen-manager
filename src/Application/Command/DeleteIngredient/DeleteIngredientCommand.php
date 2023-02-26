<?php

declare(strict_types=1);

namespace Kitman\Application\Command\DeleteIngredient;

use Kitman\Domain\Model\Recipe\NoIngredientInRecipe;
use Kitman\Domain\Model\Recipe\RecipeRepository;
use Kitman\Domain\Model\Uuid;

final class DeleteIngredientCommand
{
    public function __construct(
        private readonly RecipeRepository $repository,
    ) {
    }

    /** @throws NoIngredientInRecipe */
    public function __invoke(DeleteIngredientRequest $request): void
    {
        $recipe = $this->repository->getByUuid(
            Uuid::cast($request->uuid)
        );

        $recipe->removeIngredient($request->ingredient);

        $this->repository->persist($recipe);
    }
}