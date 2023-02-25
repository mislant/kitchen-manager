<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Kitman\Domain\Exception\DomainException;

final class IngredientAlreadyAddedInRecipe extends \DomainException implements DomainException
{
    protected $message = "Ingredient %s is already added in recipe";

    public function __construct(string $name)
    {
        parent::__construct(sprintf($this->message, $name));
    }
}