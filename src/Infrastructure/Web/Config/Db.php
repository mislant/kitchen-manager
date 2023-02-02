<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Config;

use Cycle\Database\Config\SQLite\FileConnectionConfig;
use Cycle\Database\Config\SQLiteDriverConfig;
use Kitman\Infrastructure\Web\Env\Env;

final class Db
{
    public static function get(string $root): array
    {
        return [
            'default' => 'default',
            'databases' => [
                'default' => [
                    'connection' => Env::get('CURRENT_DB')
                ]
            ],
            'connections' => [
                'sqlite' => new SQLiteDriverConfig(
                    connection: new FileConnectionConfig(
                        "$root/" . Env::get('SQLITE_FILE'),
                        [\PDO::ATTR_PERSISTENT => true]
                    )
                )
            ]
        ];
    }
}