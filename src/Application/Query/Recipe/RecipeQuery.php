<?php

declare(strict_types=1);

namespace Kitman\Application\Query\Recipe;

interface RecipeQuery
{
    /** @return RecipeView[] */
    public function allRecipes(): array;
}