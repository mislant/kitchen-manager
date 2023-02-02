<?php

declare(strict_types=1);

namespace Kitman\Tests\Unit\Domain\Model\Recipe;

use Codeception\Test\Unit;
use Kitman\Domain\Exception\InvalidArgumentException;
use Kitman\Tests\Unit\Utils\RecipeBuilder;

final class RecipeTest extends Unit
{
    public function testCannotCreateRecipeWithLongName(): void
    {
        $title = str_repeat("Verylongname", 10);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage(
            "Recipe title too long. Allowed 80 characters: " .
            strlen($title) .
            ' given!'
        );

        RecipeBuilder::default()
            ->title($title)
            ->build();
    }
}