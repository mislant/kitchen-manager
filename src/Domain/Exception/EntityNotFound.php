<?php

declare(strict_types=1);

namespace Kitman\Domain\Exception;

final class EntityNotFound extends \DomainException implements DomainException
{
    public function __construct(string $entity, ?string $by = '')
    {
        $message = "There is no object ";
        $message .= isset($by) ? "$entity by $by " : $entity;
        $message .= " in system";
        parent::__construct($message);
    }
}