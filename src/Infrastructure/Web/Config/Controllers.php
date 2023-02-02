<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Config;

use Kitman\Infrastructure\Web\Application\IndexController;
use Kitman\Infrastructure\Web\Application\Recipe\RecipeController;

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