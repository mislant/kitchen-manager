<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Persistence\Cycle;

use Cycle\Annotated\Embeddings;
use Cycle\Annotated\Entities;
use Cycle\Annotated\MergeColumns;
use Cycle\Annotated\MergeIndexes;
use Cycle\Annotated\TableInheritance;
use Cycle\Database\Config\DatabaseConfig;
use Cycle\Database\DatabaseManager;
use Cycle\ORM\Factory;
use Cycle\ORM\ORM;
use Cycle\ORM\Schema;
use Cycle\ORM\SchemaInterface;
use Cycle\Schema\Compiler;
use Cycle\Schema\Generator\GenerateModifiers;
use Cycle\Schema\Generator\GenerateRelations;
use Cycle\Schema\Generator\GenerateTypecast;
use Cycle\Schema\Generator\RenderModifiers;
use Cycle\Schema\Generator\RenderRelations;
use Cycle\Schema\Generator\RenderTables;
use Cycle\Schema\Generator\ResetTables;
use Cycle\Schema\Generator\ValidateEntities;
use Cycle\Schema\Registry;
use Psr\SimpleCache\CacheInterface;
use Spiral\Tokenizer\ClassLocator;
use Symfony\Component\Finder\Finder;

final class OrmFactory
{
    private const SCHEMA = "cycle_schema_cache";

    public function __construct(
        private readonly array $config,
        private readonly ?CacheInterface $cache
    ) {
    }

    public function produce(): ORM
    {
        return new ORM(
            new Factory(
                new DatabaseManager(
                    new DatabaseConfig(
                        $this->config
                    )
                ),
            ),
            $this->generateSchema()
        );
    }

    private function generateSchema(): SchemaInterface
    {
        return $this->inCache()
            ? $this->cachedSchema()
            : $this->newSchema();
    }

    private function inCache(): bool
    {
        return $this->canCache() &&
            $this->cache->has(self::SCHEMA);
    }

    private function canCache(): bool
    {
        return isset($this->cache);
    }

    private function cachedSchema(): Schema
    {
        return new Schema(
            $this->cache->get(self::SCHEMA)
        );
    }

    private function newSchema(): Schema
    {
        $finder = (new Finder())
            ->in(\Yii::getAlias('@app/src'))
            ->contains(
                '#[Entity'
            );
        $locator = new ClassLocator($finder);
        $schema = (new Compiler())->compile(
            new Registry(
                new DatabaseManager(new DatabaseConfig($this->config))
            ),
            [
                new ResetTables(),
                new Embeddings($locator),
                new Entities($locator),
                new TableInheritance(),
                new MergeColumns(),
                new GenerateRelations(),
                new GenerateModifiers(),
                new ValidateEntities(),
                new RenderTables(),
                new RenderRelations(),
                new RenderModifiers(),
                new MergeIndexes(),
                new GenerateTypecast(),
            ]
        );

        if ($this->canCache()) {
            $this->cache->set(self::SCHEMA, $schema);
        }

        return new Schema($schema);
    }
}