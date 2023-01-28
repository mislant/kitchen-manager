<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Config;

use Kitman\Infrastructure\Web\Controller;

final class Controllers
{
    public static function get(): array
    {
        return [
            'site' => Controller::class
        ];
    }
}