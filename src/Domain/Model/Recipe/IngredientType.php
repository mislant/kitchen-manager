<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Kitman\Domain\Exception\InvalidArgumentException;

enum IngredientType: string
{
    case liquid = 'liquid';
    case countable = 'countable';
    case solid = 'solid';

    public static function cast(string $type): self
    {
        $new = self::tryFrom($type);

        if (is_null($new)) {
            throw new InvalidArgumentException("There is no ingredient type $type!");
        }

        return $new;
    }

    public function metric(): string
    {
        return match ($this) {
            self::solid => 'gm',
            self::liquid => 'ml',
            self::countable => 'piece'
        };
    }
}