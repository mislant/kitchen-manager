<?php

declare(strict_types=1);

namespace Kitman\Domain\Model\Recipe;

use Cycle\Annotated\Annotation\Column;
use Cycle\Annotated\Annotation\Entity;
use Kitman\Domain\Model\Uuid;

#[Entity(table: 'recipe')]
class Recipe
{
    #[Column(type: 'integer', name: 'id', primary: true)]
    private int $id;

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
    }

    public static function new(
        string $name,
        float $calories,
        string $description
    ): self {
        return new self(
            Uuid::new(),
            $name,
            $calories,
            $description
        );
    }
}