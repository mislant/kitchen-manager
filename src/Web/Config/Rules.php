<?php

declare(strict_types=1);

namespace Kitman\Web\Config;

final class Rules
{
    public static function get(): array
    {
        return [
            [
                'pattern' => 'recipe/<uuid:\w{8}(-\w{4}){3}-\w{12}>',
                'route' => 'recipe/view',
            ],
            [
                'pattern' => 'recipe/<uuid:\w{8}(-\w{4}){3}-\w{12}>/ingredient/<name:\w+>/<action>',
                'route' => 'recipe/<action>-ingredient',
            ],
            [
                'pattern' => 'recipe/<uuid:\w{8}(-\w{4}){3}-\w{12}>/<action>',
                'route' => 'recipe/<action>',
            ],
        ];
    }
}