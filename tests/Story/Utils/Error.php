<?php

declare(strict_types=1);

namespace Kitman\Tests\Story\Utils;

use Exception;
use Kitman\Domain\Model\Recipe\IngredientAlreadyAddedInRecipe;
use Kitman\Domain\Model\Recipe\RecipeExists;

final class Error
{
    private array $map = [
        'same recipe' => RecipeExists::class,
        'same ingredient in recipe' => IngredientAlreadyAddedInRecipe::class,
    ];

    private function __construct(
        private readonly string $error,
    ) {
    }

    public static function from(string $error): self
    {
        return new self($error);
    }

    /** @return class-string<Exception> */
    public function class(): string
    {
        return $this->map[$this->error] ?? '';
    }
}