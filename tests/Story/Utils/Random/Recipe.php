<?php

declare(strict_types=1);

namespace Kitman\Tests\Story\Utils\Random;

final class Recipe
{
    public function name(): string
    {
        return substr(uniqid("dish_", true), 0, 80);
    }
}