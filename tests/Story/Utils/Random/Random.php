<?php

declare(strict_types=1);

namespace Kitman\Tests\Story\Utils\Random;

final class Random
{
    public static function ingredient(): Ingredient
    {
        return new Ingredient();
    }

    public static function recipe(): Recipe
    {
        return new Recipe();
    }
}