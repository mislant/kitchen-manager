<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateRecipeTable extends AbstractMigration
{
    public function change(): void
    {
        $recipe = $this->table('recipe');
        $recipe->addColumn('uuid', 'uuid', ['null' => false])
            ->addColumn('name', 'string')
            ->addColumn('calories', 'float')
            ->addColumn('description', 'text')
            ->addIndex(['uuid'], ['unique' => true])
            ->create();
    }
}
