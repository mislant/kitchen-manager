<?php

declare(strict_types=1);

namespace Kitman\Infrastructure\Persistence\Cycle;

use Cycle\ORM\Collection\CollectionFactoryInterface;
use Cycle\ORM\Exception\CollectionFactoryException;
use Kitman\Domain\Model\Collection;

/**
 * @template TEntity
 * @template-extends CollectionFactoryInterface<Collection<TEntity>>
 */
final class CollectionFactory implements CollectionFactoryInterface
{
    /** @var class-string<Collection<TEntity>> */
    private string $class = Collection::class;

    public function getInterface(): ?string
    {
        return Collection::class;
    }

    public function withCollectionClass(string $class): static
    {
        $new = clone $this;
        if (is_a($class, Collection::class, true)) {
            $new->class = $class;
        }
        return $new;
    }

    public function collect(iterable $data): iterable
    {
        if ($this->class === Collection::class) {
            throw new CollectionFactoryException("Domain collection should be specified class");
        }

        $class = $this->class;
        return new $class($data);
    }
}