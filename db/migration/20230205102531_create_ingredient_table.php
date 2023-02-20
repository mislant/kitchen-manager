<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateIngredientTable extends AbstractMigration
{
    public function change(): void
    {
        $this->table("ingredient")
            ->addColumn('name', 'string')
            ->addColumn('amount', 'float')
            ->addColumn('type', 'string')
            ->addColumn('recipe_id', 'integer')
            ->addForeignKey(
                'recipe_id',
                'recipe',
                'id',
                [
                    'delete' => 'CASCADE',
                    'update' => 'NO_ACTION'
                ]
            )->create();
    }
}
