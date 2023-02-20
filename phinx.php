<?php

use Kitman\Web\Env\Env;

Env::init(__DIR__);

return [
    'paths' => [
        'migrations' => '%%PHINX_CONFIG_DIR%%/db/migration',
        'seeds' => '%%PHINX_CONFIG_DIR%%/db/seeds'
    ],
    'environments' => [
        'default_migration_table' => 'phinxlog',
        'default_environment' => Env::get('CURRENT_DB'),
        'sqlite' => [
            'adapter' => 'sqlite',
            'name' => '%%PHINX_CONFIG_DIR%%/' . Env::get('SQLITE_FILE'),
            'suffix' => ''
        ],
    ],
    'version_order' => 'creation'
];
