<?php

declare(strict_types=1);

namespace Kitman\Tests\Story\Utils;

use Codeception\Exception\ModuleException;
use Codeception\Module;
use Codeception\TestInterface;

/**
 * Module to reuse objects and other things between
 * steps in scenario
 */
final class Memory extends Module
{
    private array $things = [];

    /** Remember something to use later in scenario */
    public function remember(string $what, mixed $thing): void
    {
        $this->things[$what] = $thing;
    }

    /**
     * Get from memory thing if you remembered it
     * @throws ModuleException
     */
    public function have(string $what): mixed
    {
        if (!isset($this->things[$what])) {
            throw new ModuleException($this, "There is nothing to get");
        }

        return $this->things[$what];
    }

    public function _before(TestInterface $test): void
    {
        $this->things = [];
    }
}