<?php

declare(strict_types=1);

namespace Kitman\Application\Query\Recipe;

use Cycle\Database\Driver\DriverInterface;

final class SqliteRecipeQuery implements RecipeQuery
{
    public function __construct(
        private readonly DriverInterface $connection
    ) {
    }

    /** @return Recipe[] */
    public function allRecipes(): array
    {
        $recipes = $this->connection->query(
            <<<SQL
            select uuid, name, calories, description from recipe
            SQL
        )->fetchAll();

        foreach ($recipes as &$recipe) {
            $recipe = new Recipe(
                $recipe['uuid'],
                $recipe['name'],
                $recipe['calories'],
                $recipe['description']
            );
        }

        return $recipes;
    }
}