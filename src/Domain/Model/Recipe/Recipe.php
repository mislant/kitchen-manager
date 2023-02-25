<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Cycle\Annotated\Annotation\Relation\HasMany;
use Kitman\Domain\Exception\InvalidArgumentException;
use Kitman\Domain\Model\Uuid;

#[Entity(table: 'recipe')]
class Recipe
{
    #[Column(type: 'integer', name: 'id', primary: true)]
    private ?int $id = null;
    #[HasMany(target: Ingredient::class, collection: Ingredients::class)]
    private Ingredients $ingredients;

    /** @throws InvalidArgumentException */
    public function __construct(
        #[Column(type: 'string', name: 'uuid', typecast: [Uuid::class, 'cast'])]
        private Uuid $uuid,
        #[Column(type: 'string', name: 'name')]
        private string $name,
        #[Column(type: 'float', name: 'calories')]
        private float $calories,
        #[Column(type: 'string', name: 'description')]
        private string $description,

    ) {
        $this->ingredients ??= new Ingredients();

        if (strlen($this->name) > 80) {
            throw new InvalidArgumentException(
                "Recipe name too long. Allowed 80 characters: "
                . strlen($this->name) . ' given!'
            );
        }
    }

    /** @throws InvalidArgumentException */
    public static function new(
        string $title,
        float $calories,
        string $description
    ): self {
        return new self(
            Uuid::new(),
            $title,
            $calories,
            $description
        );
    }

    public function uuid(): Uuid
    {
        return $this->uuid;
    }

    public function addIngredient(string $name, float $amount, IngredientType $type): void
    {
        if ($this->ingredients->has($name)) {
            throw new IngredientAlreadyAddedInRecipe($name);
        }

        $ingredient = (new Ingredient($name, $amount, $type));
        if ($this->id !== null) {
            $ingredient = $ingredient->ofRecipe($this->id);
        }

        $this->ingredients[] = $ingredient;
    }

    public function ingredients(): Ingredients
    {
        return $this->ingredients;
    }
}