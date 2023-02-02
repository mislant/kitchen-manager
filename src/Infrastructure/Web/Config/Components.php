<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Config;

use Kitman\Infrastructure\Web\Env\Env;

final class Components
{
    public static function get(): array
    {
        return [
            'request' => [
                'cookieValidationKey' => Env::get("COOKIE_VALIDATION_KEY"),
            ],
            'errorHandler' => [
                'errorAction' => 'site/error'
            ],
            'urlManager' => [
                'enablePrettyUrl' => true,
                'showScriptName' => false,
                'rules' => [
                ],
            ],
            'assetManager' => [
                'basePath' => '@webroot/public/assets'
            ]
        ];
    }
}