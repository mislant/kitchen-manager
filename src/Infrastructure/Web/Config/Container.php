<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Config;

use Cycle\Database\Driver\DriverInterface;
use Cycle\ORM\ORM;
use Kitman\Application\Query\Recipe\RecipeQuery;
use Kitman\Application\Query\Recipe\SqliteRecipeQuery;
use Kitman\Domain\Model\Recipe\RecipeRepository;
use Kitman\Infrastructure\Persistence\Cycle\OrmFactory;
use Kitman\Infrastructure\Persistence\Cycle\Repository\CycleRecipeRepository;
use Kitman\Infrastructure\Web\Env\Env;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use Symfony\Component\Cache\Psr16Cache;
use yii\base\InvalidConfigException;

final class Container
{
    public static function get(): array
    {
        return [
            'definitions' => [
                ORM::class => fn(\yii\di\Container $di) => $di
                    ->get(OrmFactory::class)
                    ->produce(),
                OrmFactory::class => fn(\yii\di\Container $di) => new OrmFactory(
                    \Yii::$app->params['db'],
                    Env::get('SCHEMA_CACHE_ENABLE') === 1
                        ? $di->get('cache.file')
                        : null
                ),
                DriverInterface::class => fn(\yii\di\Container $di) => $di
                    ->get(ORM::class)
                    ->getFactory()
                    ->database()
                    ->getDriver(),
                'cache.file' => fn(\yii\di\Container $di) => new Psr16Cache(
                    new FilesystemAdapter(directory: \Yii::getAlias('@runtime'))
                ),
                RecipeRepository::class => CycleRecipeRepository::class,
                RecipeQuery::class => function (\yii\di\Container $di) {
                    return match (Env::get('CURRENT_DB')) {
                        'sqlite' => $di->get(SqliteRecipeQuery::class),
                        default => throw new InvalidConfigException("Invalid database")
                    };
                }
            ]
        ];
    }
}