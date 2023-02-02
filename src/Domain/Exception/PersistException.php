<?php

declare(strict_types=1);

namespace Kitman\Domain\Exception;

/** @template TEntity of object */
final class PersistException extends \RuntimeException implements DomainException
{
    protected $message = "Entity persist error";
    /** @var object<TEntity> */
    private object $entity;
    private string $details;

    public function __construct(object $entity, \Throwable $previous)
    {
        $this->entity = $entity;
        $this->details = $previous->getMessage();
        parent::__construct($this->message, previous: $previous);
    }

    /** @return class-string<TEntity> */
    public function entity(): string
    {
        return $this->entity::class;
    }

    public function details(): string
    {
        return $this->details;
    }
}