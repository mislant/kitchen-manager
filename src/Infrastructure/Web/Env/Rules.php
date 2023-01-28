<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Env;

use Dotenv\Dotenv;

final class Rules
{
    public static function check(Dotenv $env): void
    {
        $env->required("COOKIE_VALIDATION_KEY");
    }
}