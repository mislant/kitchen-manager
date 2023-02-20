<?php

declare(strict_types=1);

namespace Kitman\Application\Query\Recipe;

use Kitman\Application\Query\Recipe\Model\DetailedRecipe;
use Kitman\Application\Query\Recipe\Model\RecipePreview;
use PhpOption\Option;

interface RecipeQuery
{
    /** @return RecipePreview[] */
    public function previewAllRecipes(): iterable;

    /** @psalm-return  Option<DetailedRecipe> */
    public function detailedRecipe(string $uuid): Option;
}