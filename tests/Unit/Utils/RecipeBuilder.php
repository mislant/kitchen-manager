<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Utils;

use Kitman\Domain\Exception\InvalidArgumentException;
use Kitman\Domain\Model\Recipe\Recipe;

final class RecipeBuilder
{
    public function __construct(
        private string $title,
        private int $calories,
        private string $description
    ) {
    }

    public static function default(): self
    {
        return new self("Dish", 100, "Test dish");
    }

    public function title(string $title): self
    {
        $this->title = $title;
        return $this;
    }

    public function calories(int $calories): self
    {
        $this->calories = $calories;
        return $this;
    }

    public function description(string $description): self
    {
        $this->description = $description;
        return $this;
    }

    /** @throws InvalidArgumentException */
    public function build(): Recipe
    {
        return Recipe::new(
            $this->title,
            $this->calories,
            $this->description
        );
    }
}