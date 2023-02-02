<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Helper;

final class Url extends \yii\helpers\Url
{
    private const ADD_RECIPE = "/recipe/new";
    private const EDIT_RECIPE = "/#";

    public static function addRecipe(): string
    {
        return self::to(self::ADD_RECIPE);
    }

    public static function editRecipe(string $uuid): string
    {
        return self::to([self::EDIT_RECIPE, 'uuid' => $uuid]);
    }
}