<?php

declare(strict_types=1);

namespace Kitman\Domain\Exception;

final class InvalidArgumentException extends \InvalidArgumentException implements DomainException
{
}