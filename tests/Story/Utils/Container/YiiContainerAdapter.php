<?php

declare(strict_types=1);

namespace Kitman\Tests\Story\Utils\Container;

use Psr\Container\ContainerInterface;

/**
 * Adapts current application container for PSR
 */
final class YiiContainerAdapter implements ContainerInterface
{
    public function get(string $id)
    {
        return \Yii::$container->get($id);
    }

    public function has(string $id): bool
    {
        return \Yii::$container->has($id);
    }
}