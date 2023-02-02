<?php

declare(strict_types=1);

namespace Kitman\Tests\Story\Utils\Container;

use Codeception\Exception\ModuleException;
use Codeception\Lib\Interfaces\DependsOnModule;
use Codeception\Module;
use Psr\Container\ContainerInterface;

final class Container extends Module implements DependsOnModule
{
    private ContainerInterface $container;
    private Module\Yii2 $yii2;

    public function _depends(): array
    {
        return [Module\Yii2::class => "Required application"];
    }

    public function _inject(Module\Yii2 $yii2): void
    {
        $this->yii2 = $yii2;
    }


    public function _initialize(): void
    {
        $this->container = new YiiContainerAdapter();
    }

    /**
     * Retrieves service from
     * container
     *
     * @template TObject
     * @param class-string<TObject>|string $object
     * @return TObject
     * @throws ModuleException
     */
    public function need(string $object): object
    {
        try {
            return $this->container->get($object);
        } catch (\Throwable $e) {
            throw new ModuleException($this, "Resolve error: {$e->getMessage()}");
        }
    }
}