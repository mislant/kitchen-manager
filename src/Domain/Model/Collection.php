<?php

declare(strict_types=1);

namespace Kitman\Domain\Model;

use Kitman\Domain\Exception\InvalidArgumentException;
use Ramsey\Collection\Collection as RamseyCollection;
use Ramsey\Collection\Exception\InvalidArgumentException as RamseyInvalidArgumentException;
use Traversable;

/**
 * @template TEntity
 */
abstract class Collection implements \ArrayAccess, \IteratorAggregate, \Countable
{
    /** @var RamseyCollection<TEntity> */
    protected RamseyCollection $collection;

    /** @param TEntity[] $data */
    final public function __construct(array $data = [])
    {
        try {
            $this->collection = new RamseyCollection($this->of(), $data);
        } catch (RamseyInvalidArgumentException $e) {
            throw new InvalidArgumentException(
                $e->getMessage(),
                previous: $e
            );
        }
    }

    /** @return class-string<TEntity> */
    abstract public function of(): string;

    /** @return Traversable<int, TEntity> */
    public function getIterator(): Traversable
    {
        return $this->collection->getIterator();
    }

    public function offsetExists(mixed $offset): bool
    {
        return $this->collection->offsetExists($offset);
    }

    /** @return TEntity */
    public function offsetGet(mixed $offset): object
    {
        return $this->collection->offsetGet($offset);
    }

    /**
     * @param int|string $offset
     * @param TEntity $value
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        try {
            $this->collection->offsetSet($offset, $value);
        } catch (RamseyInvalidArgumentException $e) {
            throw new InvalidArgumentException($e->getMessage(), previous: $e);
        }
    }

    public function offsetUnset(mixed $offset): void
    {
        $this->collection->offsetUnset($offset);
    }

    public function count(): int
    {
        return $this->collection->count();
    }
}