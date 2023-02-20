<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Kitman\Domain\Model\ValueObject;

#[Entity(table: 'ingredient')]
class Ingredient implements ValueObject
{
    #[Column(type: 'primary', name: 'id')]
    private int $id;
    #[Column(type: 'integer', name: 'recipe_id')]
    private int $recipeId;

    public function __construct(
        #[Column(type: 'string', name: 'name')]
        private string $name,
        #[Column(type: 'float', name: 'amount')]
        private float $amount,
        #[Column(type: 'string', typecast: IngredientType::class)]
        private IngredientType $type,
    ) {
    }

    public function ofRecipe(int $id): self
    {
        $new = clone $this;
        $new->recipeId = $id;
        return $new;
    }

    public static function liquid(string $name, float $ml): self
    {
        return new self($name, $ml, IngredientType::liquid);
    }

    public static function countable(string $name, float $piece): self
    {
        return new self($name, $piece, IngredientType::countable);
    }

    public static function solid(string $name, float $gm): self
    {
        return new self($name, $gm, IngredientType::solid);
    }

    public function equals(object $object): bool
    {
        return $object instanceof $this &&
            $this->type === $object->type &&
            $this->amount === $object->amount &&
            $this->name === $object->name;
    }
}