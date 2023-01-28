<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Web\Config;

final class Main
{
    public static function get(string $root): array
    {
        return [
            'id' => 'kitman',
            'basePath' => $root,
            'aliases' => [
                '@bower' => '@vendor/bower-asset',
                '@npm' => '@vendor/npm-asset',
            ],
            'viewPath' => "@app/app/views",
            'runtimePath' => "@app/app/runtime",
            'controllerMap' => Controllers::get(),
            'components' => Components::get()
        ];
    }
}