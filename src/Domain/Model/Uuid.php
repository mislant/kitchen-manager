<?php

declare(strict_types=1);

namespace Kitman\Domain\Model;

use Kitman\Domain\Exception\InvalidArgumentException;
use Ramsey\Uuid\Uuid as RamseyUuid;
use Ramsey\Uuid\UuidInterface;

final class Uuid implements \Stringable
{
    private function __construct(
        private readonly UuidInterface $uuid
    ) {
    }

    public static function new(): self
    {
        return new self(RamseyUuid::uuid7());
    }

    public static function cast(string $uuid): self
    {
        RamseyUuid::isValid($uuid)
            ?: throw new InvalidArgumentException("Uuid is invalid format");
        return new self(RamseyUuid::fromString($uuid));
    }

    public function value(): string
    {
        return (string)$this;
    }

    public function __toString()
    {
        return $this->uuid->toString();
    }
}