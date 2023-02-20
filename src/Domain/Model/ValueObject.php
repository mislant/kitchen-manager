<?php

declare(strict_types=1);

namespace Kitman\Domain\Model;

interface ValueObject
{
    public function equals(object $object): bool;
}