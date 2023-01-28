<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Env;

use Dotenv\Dotenv;
use Dotenv\Repository\RepositoryBuilder;
use Dotenv\Repository\RepositoryInterface;

final class Env
{
    private static RepositoryInterface $repository;

    public static function init(string ...$envs): void
    {
        $repository = RepositoryBuilder::createWithDefaultAdapters()
            ->make();
        self::$repository = $repository;

        $dotenv = Dotenv::create($repository, $envs);
        $dotenv->load();

        Rules::check($dotenv);
    }

    public static function get(string $key): mixed
    {
        return self::$repository->get($key);
    }

    public static function set(string $key, string $value): void
    {
        self::$repository->set($key, $value);
    }
}