<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Kitman\Domain\Exception\InvalidArgumentException;
use Kitman\Domain\Model\Uuid;

#[Entity(table: 'recipe')]
class Recipe
{
    #[Column(type: 'integer', name: 'id', primary: true)]
    private int $id;

    /** @throws InvalidArgumentException */
    public function __construct(
        #[Column(type: 'string', name: 'uuid', typecast: [Uuid::class, 'cast'])]
        private Uuid $uuid,
        #[Column(type: 'string', name: 'title')]
        private string $title,
        #[Column(type: 'float', name: 'calories')]
        private float $calories,
        #[Column(type: 'string', name: 'description')]
        private string $description,
    ) {
        if (strlen($this->title) > 80) {
            throw new InvalidArgumentException(
                "Recipe title too long. Allowed 80 characters: "
                . strlen($this->title) . ' given!'
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
}