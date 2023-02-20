<?php

declare(strict_types=1);

namespace Kitman\Web\Config;

use Kitman\Web\Application\IndexController;
use Kitman\Web\Application\Recipe\RecipeController;

final class Controllers
{
    public static function get(): array
    {
        return [
            'site' => IndexController::class,
            'recipe' => RecipeController::class,
        ];
    }
}