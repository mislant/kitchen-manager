<?php

declare(strict_types=1);

namespace Kitman\Tests\Support;

use Codeception\Attribute\Given;
use Codeception\Attribute\Then;
use Codeception\Attribute\When;
use Kitman\Application\Command\AddRecipe\AddRecipeCommand;
use Kitman\Application\Command\AddRecipe\AddRecipeRequest;
use Kitman\Application\Query\Recipe\RecipeQuery;
use Kitman\Domain\Model\Recipe\RecipeExists;

/**
 * Inherited Methods
 * @method void wantTo($text)
 * @method void wantToTest($text)
 * @method void execute($callable)
 * @method void expectTo($prediction)
 * @method void expect($prediction)
 * @method void amGoingTo($argumentation)
 * @method void am($role)
 * @method void lookForwardTo($achieveValue)
 * @method void comment($description)
 * @method void pause($vars = [])
 *
 * @SuppressWarnings(PHPMD)
 */
class StoryTester extends \Codeception\Actor
{
    use _generated\StoryTesterActions;

    #[Given('empty recipes list')]
    public function emptyRecipes(): void
    {
        $query = $this->need(RecipeQuery::class);

        $recipes = $query->allRecipes();

        $this->assertEmpty($recipes);
    }

    #[When('I write new recipe')]
    public function writeRecipe(): void
    {
        $command = $this->need(AddRecipeCommand::class);

        $command(new AddRecipeRequest("Food", 200, 'Simple food'));
    }

    #[Then('I see it in list')]
    public function checkRecipeAppeared(): void
    {
        $query = $this->need(RecipeQuery::class);

        $recipes = $query->allRecipes();

        $this->assertCount(1, $recipes);
        $this->assertEquals(
            ['Food', 200, 'Simple food'],
            [
                $recipes[0]->title,
                $recipes[0]->calories,
                $recipes[0]->description
            ]
        );
    }

    #[Given('Certain recipe')]
    public function certainRecipe(): void
    {
        $command = $this->need(AddRecipeCommand::class);

        $name = substr(uniqid("dish_", true), 0, 80);
        $this->remember("Dish", $name);

        $command(new AddRecipeRequest($name, 200.0, 'Simple food'));
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

    #[Then('I have error of same recipe')]
    public function haveErrorOfSameRecipe(): void
    {
        $result = $this->have("Result");

        $this->assertIsObject($result);
        $this->assertInstanceOf(RecipeExists::class, $result);
    }
}
