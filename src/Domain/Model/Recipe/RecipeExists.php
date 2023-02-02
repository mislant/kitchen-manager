<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Kitman\Domain\Exception\DomainException;

final class RecipeExists extends \DomainException implements DomainException
{
    protected $message = 'Recipe of %s is already exists';

    public function __construct(string $name)
    {
        parent::__construct(
            sprintf($this->message, $name)
        );
    }
}