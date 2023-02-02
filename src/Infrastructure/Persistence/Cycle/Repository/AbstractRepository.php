<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Persistence\Cycle\Repository;

use Cycle\ORM\EntityManager;
use Cycle\ORM\ORM;
use Cycle\ORM\Select\Repository;

/** @template TEntity */
abstract class AbstractRepository
{
    /** @var Repository<TEntity> */
    protected Repository $repository;

    public function __construct(
        private readonly ORM $ORM
    ) {
        $this->repository = $this->ORM
            ->getRepository($this->entity());
    }

    /** @return class-string<EntityManager> */
    abstract protected function entity(): string;

    protected function transaction(): EntityManager
    {
        return new EntityManager($this->ORM);
    }
}