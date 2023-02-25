<?php

declare(strict_types=1);

namespace Kitman\Tests\Story;

use Codeception\Attribute\Given;
use Codeception\Attribute\Then;
use Codeception\Attribute\When;
use Cycle\Database\Driver\DriverInterface;
use Kitman\Application\Command\AddIngredient\AddIngredientCommand;
use Kitman\Application\Command\AddIngredient\AddIngredientRequest;
use Kitman\Application\Command\AddRecipe\AddRecipeCommand;
use Kitman\Application\Command\AddRecipe\AddRecipeRequest;
use Kitman\Application\Query\Recipe\RecipeQuery;
use Kitman\Tests\Story\Utils\Error;
use Kitman\Tests\Story\Utils\Random\Random;

/**
 * @psalm-require-extends \Kitman\Support\StoryTester
 */
trait Steps
{
    #[Given('Empty recipes list')]
    public function emptyRecipes(): void
    {
        $this->need(DriverInterface::class)
            ->execute("delete from recipe;");
    }

    #[Given('Certain recipe')]
    public function certainRecipe(): void
    {
        $name = Random::recipe()->name();
        $this->remember("Dish", $name);

        $command = $this->need(AddRecipeCommand::class);
        $uuid = $command(new AddRecipeRequest($name, 200.0, 'Simple food'));

        $this->remember($name, $uuid);
    }

    #[When('I write new recipe')]
    public function writeRecipe(): void
    {
        $command = $this->need(AddRecipeCommand::class);

        $command(new AddRecipeRequest("Food", 200, 'Simple food'));
    }

    #[When('I write same recipe')]
    public function writeSameRecipe(): void
    {
        $command = $this->need(AddRecipeCommand::class);
        $name = $this->have("Dish");

        try {
            $this->remember(
                "Result",
                $command(
                    new AddRecipeRequest(
                        $name,
                        100,
                        'Another food'
                    )
                )
            );
        } catch (\Throwable $t) {
            $this->remember("Result", $t);
        }
    }

    #[When('/^I add ingredient( \w+)?$/')]
    public function addIngredient(string $name = ''): void
    {
        $command = $this->need(AddIngredientCommand::class);
        try {
            $command(
                new AddIngredientRequest(
                    $this->have($this->have("Dish")),
                    $name = empty($name)
                        ? Random::ingredient()->name()
                        : trim($name),
                    Random::ingredient()->amount(),
                    Random::ingredient()->type()->name
                )
            );
            $this->remember("Ingredient", $name);
        } catch (\Throwable $t) {
            $this->remember("Result", $t);
        }
    }

    #[Then('I see it in list')]
    public function checkRecipeAppeared(): void
    {
        $recipes = $this->need(RecipeQuery::class)
            ->previewAllRecipes();

        $this->assertCount(1, $recipes);
        $this->assertEquals(
            ['Food', 200, 'Simple food'],
            [
                $recipes[0]->name,
                $recipes[0]->calories,
                $recipes[0]->description
            ]
        );
    }

    #[Then('I see it in recipe')]
    public function checkIngredientAppear(): void
    {
        $recipe = $this->need(RecipeQuery::class)
            ->detailedRecipe($this->have($this->have("Dish")));

        $this->assertEquals(
            $this->have('Ingredient'),
            $recipe->get()->ingredients[0]->name
        );
    }

    #[Then('/I have error of ([\w ]+)/')]
    public function haveErrorOf(string $error): void
    {
        $result = $this->have("Result");

        $this->assertIsObject($result);
        /** @noinspection UnnecessaryAssertionInspection */
        $this->assertInstanceOf(
            Error::from($error)->class(),
            $result
        );
    }
}