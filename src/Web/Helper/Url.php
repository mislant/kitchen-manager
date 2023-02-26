<?php

declare(strict_types=1);

namespace Kitman\Web\Helper;

final class Url extends \yii\helpers\Url
{
    private const ADD_RECIPE = "recipe/new";
    private const ADD_INGREDIENT = "recipe/add-ingredient";
    private const DELETE_INGREDIENT = "recipe/delete-ingredient";
    private const VIEW_RECIPE = "recipe/view";

    public static function addRecipe(): string
    {
        return self::toRoute(self::ADD_RECIPE);
    }

    public static function addIngredient(string $uuid): string
    {
        return self::toRoute([self::ADD_INGREDIENT, 'uuid' => $uuid]);
    }

    public static function viewRecipe(string $uuid): string
    {
        return self::toRoute([self::VIEW_RECIPE, 'uuid' => $uuid]);
    }

    public static function deleteIngredient(string $uuid, string $name): string
    {
        return self::toRoute([self::DELETE_INGREDIENT, 'uuid' => $uuid, 'name' => $name]);
    }
}