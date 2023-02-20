<?php

declare(strict_types=1);

namespace Kitman\Web\Env;

use Dotenv\Dotenv;

final class Rules
{
    public static function check(Dotenv $env): void
    {
        $env->required("COOKIE_VALIDATION_KEY");

        $env->required('SCHEMA_CACHE_ENABLE')
            ->isBoolean();

        $env->required('CURRENT_DB')
            ->allowedValues(['sqlite']);
        match (Env::get('CURRENT_DB')) {
            'sqlite' => $env->required('SQLITE_FILE')
        };
    }
}