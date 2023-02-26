<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Kitman\Domain\Exception\DomainException;

final class NoIngredientInRecipe extends \DomainException implements DomainException
{
    protected $message = "No such ingredient %s in %s recipe";

    public function __construct(string $ingredient, string $recipe)
    {
        parent::__construct(sprintf($this->message, $ingredient, $recipe));
    }
}