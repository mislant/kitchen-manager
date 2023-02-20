<?php

declare(strict_types=1);

namespace Kitman\Application\Query\Recipe;

use Cycle\Database\Driver\DriverInterface;
use Kitman\Application\Query\Recipe\Model\DetailedRecipe;
use Kitman\Application\Query\Recipe\Model\Ingredient;
use Kitman\Application\Query\Recipe\Model\RecipePreview;
use Kitman\Domain\Model\Recipe\IngredientType;
use PhpOption\Option;
use Ramsey\Collection\Collection;

final class SqliteRecipeQuery implements RecipeQuery
{
    public function __construct(
        private readonly DriverInterface $connection
    ) {
    }

    /** @return RecipePreview[] */
    public function previewAllRecipes(): iterable
    {
        return (new Collection(
            'mixed',
            $this->connection->query(
                <<<SQL
                select uuid, name, calories, description from recipe
                SQL
            )->fetchAll()
        ))->map(static function ($row) {
            return new RecipePreview(
                $row['uuid'],
                $row['name'],
                $row['calories'],
                $row['description']
            );
        });
    }

    public function detailedRecipe(string $uuid): Option
    {
        return (Option::fromValue(
            $this->connection->query(
                <<<SQL
                select r.uuid,
                       r.name,
                       r.calories,
                       r.description,
                       json_group_array(
                               json_object(
                                   'name', i.name,
                                   'amount', i.amount,
                                   'type', i.type
                                   )
                           ) as ingredients
                from recipe as r
                         left join ingredient as i on r.id = i.recipe_id
                where r.uuid = :p0
                group by r.uuid
                SQL,
                ['p0' => $uuid]
            )->fetch(),
            []
        ))->flatMap(static function ($recipe) {
            return Option::fromValue(
                new DetailedRecipe(
                    $recipe['uuid'],
                    $recipe['name'],
                    $recipe['calories'],
                    $recipe['description'],
                    (new Collection('mixed', json_decode($recipe['ingredients'], true)))
                        ->filter(static function (array $ingredient) {
                            return !is_null($ingredient['name']);
                        })
                        ->map(static function (array $ingredient) {
                            return new Ingredient(
                                $ingredient['name'],
                                $ingredient['amount'],
                                IngredientType::cast($ingredient['type'])->metric()
                            );
                        })
                )
            );
        });
    }
}